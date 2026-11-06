# Product Catalog Engine & Architecture Implementation Guide

> **E-Commerce Fashion & Dress Store (Indian Market)**  
> **Framework**: Laravel 13 (PHP 8.4)  
> **Database**: Neon Serverless PostgreSQL with PgBouncer Pooling  
> **Primary Identifier Pattern**: RFC 4122 UUID v4 (`gen_random_uuid()`)  

---

## 1. Architectural Strategy & Normalization Decisions

| Domain Component | Architectural Pattern | Why This Pattern Was Chosen |
| :--- | :--- | :--- |
| **Base Products vs. SKUs** | **3NF Split (`products` + `product_variants`)** | Separates shared marketing/SEO metadata (`products`) from physical purchasable units (`product_variants`). Prevents data duplication across size/color matrices while keeping SKU lookups lightweight. |
| **Dynamic Attributes** | **Hybrid Attribute Registry + `JSONB` (`jsonb_path_ops`)** | Traditional EAV (Entity-Attribute-Value) requires 6 to 10 self-joins to filter a single category page, degrading query plans at scale. Storing validated attributes in `JSONB` indexed with `GIN (jsonb_path_ops)` delivers sub-millisecond faceted filtering in a single table scan while `attribute_definitions` enforces schema governance in Laravel. |
| **Category Hierarchy** | **Adjacency List (`parent_id`) + `ltree` Materialized Path** | `parent_id` maintains referential integrity for tree mutations, while PostgreSQL's native `ltree` column (`path`) enables instant subtree queries (e.g., fetching all products under *Women's Ethnic Wear* and its nested subcategories) via a GiST index without expensive `WITH RECURSIVE` CTEs. |
| **Kits & Bundles** | **Directed Acyclic SKU Graph (`product_bundles`)** | Maps a virtual parent bundle SKU to multiple physical child SKUs with explicit quantities and discount allocation percentages. Physical stock remains normalized at the child SKU level to prevent phantom inventory drift. |
| **Multi-Warehouse Stock** | **Composite PK + Stored Generated Column** | Tracks `quantity_on_hand` and `quantity_reserved` per warehouse and SKU. PostgreSQL automatically computes `quantity_available` via a `GENERATED ALWAYS AS (quantity_on_hand - quantity_reserved) STORED` column, eliminating race conditions during checkout reservation. |
| **Indian Market Pricing** | **Multi-currency & GST Inclusive (`variant_prices`)** | Default currency is `INR` (₹). Supports MSRP/MRP, retail price, COGS, time-bound sale prices, and tiered B2B volume pricing (`variant_tiered_prices`). Includes `tax_class` (`gst_18`, `gst_12`, etc.) and `is_tax_inclusive` flag for Indian tax compliance. |

---

## 2. PostgreSQL Extensions & Custom Types

Applied via migration `2026_11_06_082751_install_postgres_extensions.php`:

```sql
-- Extensions
CREATE EXTENSION IF NOT EXISTS "pgcrypto";
CREATE EXTENSION IF NOT EXISTS "ltree";
CREATE EXTENSION IF NOT EXISTS "btree_gist";

-- ENUM Types
CREATE TYPE product_status_enum AS ENUM ('draft', 'active', 'archived');
CREATE TYPE product_type_enum AS ENUM ('simple', 'configurable', 'bundle', 'digital');
CREATE TYPE product_relation_enum AS ENUM ('accessory', 'spare_part', 'cross_sell', 'upsell', 'substitute');
CREATE TYPE attribute_type_enum AS ENUM ('text', 'number', 'boolean', 'select', 'multiselect', 'color');
```

---

## 3. Database Schema Reference (13 Tables + 1 View)

### 1. `brands`
* Brand registry (e.g., Fabindia, Manyavar, W for Woman, Biba).
* Columns: `id` (UUID PK), `name`, `slug` (UNIQUE), `logo_url`, `website_url`, `is_active`, `timestampsTz`, `deleted_at`.

### 2. `categories`
* Hierarchical tree structure using `ltree`.
* Columns: `id` (UUID PK), `parent_id` (UUID self-ref FK), `name`, `slug` (UNIQUE), `path` (`ltree`), `depth` (SMALLINT), `description`, `image_url`, `seo_metadata` (JSONB), `sort_order`, `is_active`, `timestampsTz`.
* Engine constraints: `chk_category_not_self_parent` (`id <> parent_id`), `chk_category_depth` (`depth >= 0`).

### 3. `attribute_definitions`
* Governance registry for dynamic attributes and filters.
* Columns: `id` (UUID PK), `code` (VARCHAR UNIQUE), `name`, `data_type` (`attribute_type_enum`), `unit`, `allowed_values` (JSONB), `is_variant_axis`, `is_filterable`, `is_searchable`, `is_required`, `sort_order`, `timestampsTz`.

### 4. `category_attributes`
* Junction table mapping which attributes belong to which category.
* Primary Key: `(category_id, attribute_id)`.
* Columns: `category_id`, `attribute_id`, `is_required_in_category`, `sort_order`.

### 5. `products`
* Base catalog entity holding shared product content and SEO.
* Columns: `id` (UUID PK), `brand_id` (UUID FK), `name`, `slug` (UNIQUE), `product_type` (`product_type_enum`), `status` (`product_status_enum`), `short_description`, `description`, `base_attributes` (JSONB), `seo_metadata` (JSONB), `published_at`, `timestampsTz`, `deleted_at`.

### 6. `category_product`
* Many-to-many junction between products and categories.
* Primary Key: `(category_id, product_id)`.
* Columns: `category_id`, `product_id`, `is_primary` (BOOLEAN), `sort_order`, `created_at`.
* Engine index: Partial unique index `idx_category_product_one_primary` guarantees exactly one primary category per product.

### 7. `product_variants`
* Physical, purchasable SKUs.
* Columns: `id` (UUID PK), `product_id` (UUID FK), `sku` (UNIQUE), `barcode`, `name`, `is_default`, `is_active`, `track_inventory`, `weight_grams`, `length_mm`, `width_mm`, `height_mm`, `variant_options` (JSONB), `technical_specs` (JSONB), `media_gallery` (JSONB), `sort_order`, `timestampsTz`, `deleted_at`.
* Engine index: Partial unique index `idx_variants_one_default_per_product` guarantees exactly one default SKU per product.

### 8. `product_relationships`
* Directed graph for related items: cross-sells, upsells, accessories, substitutes.
* Primary Key: `(source_product_id, target_product_id, relation_type)`.
* Constraint: `source_product_id <> target_product_id`.

### 9. `product_bundles`
* Maps a virtual parent bundle SKU to physical component SKUs.
* Primary Key: `(parent_variant_id, child_variant_id)`.
* Columns: `parent_variant_id`, `child_variant_id`, `quantity`, `revenue_allocation_pct`, `sort_order`, `created_at`.

### 10. `warehouses`
* Fulfillment locations across India (e.g. Mumbai MUM-WH1, Delhi DEL-WH1, Bangalore BLR-WH1).
* Columns: `id` (UUID PK), `code` (VARCHAR UNIQUE), `name`, `country_code` ('IN'), `state_code`, `postal_code`, `address_details` (JSONB), `priority`, `is_active`, `timestampsTz`.

### 11. `inventory_levels`
* Multi-warehouse stock tracking with zero-latency computed availability.
* Primary Key: `(warehouse_id, variant_id)`.
* Columns: `warehouse_id`, `variant_id`, `quantity_on_hand`, `quantity_reserved`, `quantity_available` (`GENERATED ALWAYS AS (quantity_on_hand - quantity_reserved) STORED`), `low_stock_threshold`, `bin_location`, `updated_at`.
* Engine constraint: `chk_reserved_within_on_hand` (`quantity_reserved <= quantity_on_hand`).

### 12. `variant_prices`
* Multi-currency selling rules and promotional sales.
* Unique Key: `(variant_id, currency_code)`.
* Columns: `id` (UUID PK), `variant_id`, `currency_code` ('INR'), `msrp_price`, `retail_price`, `cost_price`, `sale_price`, `sale_starts_at`, `sale_ends_at`, `tax_class`, `is_tax_inclusive`, `timestampsTz`.
* Engine constraints: `retail_price <= msrp_price`, `sale_price < retail_price`, and valid sale time window.

### 13. `variant_tiered_prices`
* Volume / B2B wholesale pricing tiers.
* Unique Key: `(variant_id, currency_code, customer_group, min_quantity)`.
* Columns: `id` (UUID PK), `variant_id`, `currency_code`, `customer_group`, `min_quantity`, `max_quantity`, `unit_price`, `starts_at`, `ends_at`, `timestampsTz`.

### 14. `vw_active_variant_pricing` (Database View)
* Automatically computes `effective_price` and `is_on_sale` in SQL by comparing `NOW()` against `sale_starts_at` and `sale_ends_at`.

---

## 4. File Structure & Components Implemented

```
app/
├── Actions/
│   ├── Inventory/
│   │   ├── ReleaseInventoryAction.php      # Releases reserved stock safely
│   │   ├── ReserveInventoryAction.php      # Atomically reserves stock across warehouse priorities
│   │   └── UpdateInventoryLevelAction.php  # Sets on-hand & reserved stock
│   └── Product/
│       ├── CreateProductAction.php         # Creates base product with category pivot & SEO
│       ├── CreateProductVariantAction.php  # Creates SKU with INR pricing
│       ├── UpdateProductAction.php         # Updates product and syncs categories
│       └── UpdateProductVariantAction.php  # Updates SKU and INR prices
├── Enums/
│   ├── AttributeType.php                   # text, number, boolean, select, multiselect, color
│   ├── ProductRelation.php                 # accessory, spare_part, cross_sell, upsell, substitute
│   ├── ProductStatus.php                   # draft, active, archived
│   └── ProductType.php                     # simple, configurable, bundle, digital
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── BrandController.php          # CRUD for brands
│   │   │   ├── CategoryController.php       # Tree navigation & category products via ltree
│   │   │   ├── InventoryController.php      # Multi-warehouse stock management
│   │   │   ├── ProductController.php        # Product catalog admin API
│   │   │   └── ProductVariantController.php # Variant/SKU admin API
│   │   └── ProductController.php            # Storefront catalog view controller
│   ├── Requests/
│   │   └── Admin/
│   │       ├── StoreBrandRequest.php
│   │       ├── UpdateBrandRequest.php
│   │       ├── StoreCategoryRequest.php
│   │       ├── UpdateCategoryRequest.php
│   │       ├── StoreProductRequest.php
│   │       ├── UpdateProductRequest.php
│   │       ├── StoreProductVariantRequest.php
│   │       ├── UpdateProductVariantRequest.php
│   │       └── UpdateInventoryLevelRequest.php
│   └── Resources/
│       ├── AttributeDefinitionResource.php
│       ├── BrandResource.php
│       ├── CategoryResource.php
│       ├── InventoryLevelResource.php
│       ├── ProductResource.php
│       ├── ProductVariantResource.php
│       └── VariantPriceResource.php
├── Models/
│   ├── AttributeDefinition.php
│   ├── Brand.php
│   ├── Category.php                         # HasUuids, ltree scopes: descendantsOf, ancestorsOf
│   ├── CategoryAttribute.php                # Pivot
│   ├── CategoryProduct.php                  # Pivot
│   ├── InventoryLevel.php                   # Composite PK, generated quantity_available
│   ├── Product.php                          # HasUuids, SoftDeletes, JSONB containment scope
│   ├── ProductBundle.php                    # Pivot
│   ├── ProductRelationship.php              # Pivot
│   ├── ProductVariant.php                   # HasUuids, SoftDeletes, stock calculations
│   ├── VariantPrice.php                     # Effective price & on-sale accessors
│   ├── VariantTieredPrice.php
│   └── Warehouse.php
database/
├── factories/
│   ├── AttributeDefinitionFactory.php
│   ├── BrandFactory.php
│   ├── CategoryFactory.php
│   ├── InventoryLevelFactory.php
│   ├── ProductFactory.php
│   ├── ProductVariantFactory.php
│   ├── VariantPriceFactory.php
│   └── WarehouseFactory.php
├── migrations/
│   ├── 2026_11_06_082751_install_postgres_extensions.php
│   ├── 2026_11_06_082753_create_brands_table.php
│   ├── 2026_11_06_082756_rebuild_categories_table.php
│   ├── 2026_11_06_082757_create_attribute_definitions_table.php
│   ├── 2026_11_06_082759_create_category_attributes_table.php
│   ├── 2026_11_06_082816_rebuild_products_table.php
│   ├── 2026_11_06_082817_create_category_product_table.php
│   ├── 2026_11_06_082820_rebuild_product_variants_table.php
│   ├── 2026_11_06_082821_create_product_relationships_table.php
│   ├── 2026_11_06_082823_create_product_bundles_table.php
│   ├── 2026_11_06_082832_create_warehouses_table.php
│   ├── 2026_11_06_082834_create_inventory_levels_table.php
│   ├── 2026_11_06_082836_create_variant_prices_table.php
│   ├── 2026_11_06_082838_create_variant_tiered_prices_table.php
│   └── 2026_11_06_082839_create_product_catalog_indexes_and_view.php
└── seeders/
    ├── AttributeDefinitionSeeder.php        # Indian fashion attributes: fabric, size, occasion, etc.
    ├── BrandSeeder.php                      # Fabindia, Manyavar, W, Global Desi, Biba, FabAlley
    ├── CategorySeeder.php                   # Men's, Women's, Kids' with ltree paths
    ├── DatabaseSeeder.php                   # Orchestrator
    └── ProductCatalogSeeder.php             # Kurtas, Sherwanis, Anarkalis with variants & inventory
tests/
└── Feature/
    ├── BrandManagementTest.php
    ├── CategoryManagementTest.php
    ├── InventoryReservationTest.php
    └── ProductManagementTest.php
```

---

## 5. API Endpoints Registered

All routes are under `/api/v1/`:

| Method | URI | Name | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/v1/brands` | `api.v1.brands.index` | List/search brands |
| `POST` | `/api/v1/brands` | `api.v1.brands.store` | Create brand |
| `GET` | `/api/v1/brands/{brand}` | `api.v1.brands.show` | Show brand details |
| `PUT` | `/api/v1/brands/{brand}` | `api.v1.brands.update` | Update brand |
| `DELETE` | `/api/v1/brands/{brand}` | `api.v1.brands.destroy` | Soft-delete brand |
| `GET` | `/api/v1/categories` | `api.v1.categories.index` | Category tree |
| `POST` | `/api/v1/categories` | `api.v1.categories.store` | Create category (auto ltree path) |
| `GET` | `/api/v1/categories/{category}` | `api.v1.categories.show` | Category details |
| `PUT` | `/api/v1/categories/{category}` | `api.v1.categories.update` | Update category |
| `DELETE` | `/api/v1/categories/{category}` | `api.v1.categories.destroy` | Delete category |
| `GET` | `/api/v1/categories/{category}/products` | `api.v1.categories.products` | Products in category & subcategories (`<@`) |
| `GET` | `/api/v1/products` | `api.v1.products.index` | Filter/paginate products |
| `POST` | `/api/v1/products` | `api.v1.products.store` | Create product + categories |
| `GET` | `/api/v1/products/{product}` | `api.v1.products.show` | Show product + variants + inventory |
| `PUT` | `/api/v1/products/{product}` | `api.v1.products.update` | Update product |
| `DELETE` | `/api/v1/products/{product}` | `api.v1.products.destroy` | Soft-delete product |
| `GET` | `/api/v1/products/{product}/variants` | `api.v1.products.variants.index` | List product SKUs |
| `POST` | `/api/v1/products/{product}/variants` | `api.v1.products.variants.store` | Create SKU + INR price |
| `GET` | `/api/v1/products/{product}/variants/{variant}` | `api.v1.products.variants.show` | Show SKU |
| `PUT` | `/api/v1/products/{product}/variants/{variant}` | `api.v1.products.variants.update` | Update SKU & prices |
| `DELETE`| `/api/v1/products/{product}/variants/{variant}` | `api.v1.products.variants.destroy` | Soft-delete SKU |
| `GET` | `/api/v1/inventory` | `api.v1.inventory.index` | Inventory levels (low stock filter) |
| `GET` | `/api/v1/inventory/warehouses` | `api.v1.inventory.warehouses` | List warehouses |
| `GET` | `/api/v1/inventory/variants/{variant}` | `api.v1.inventory.variant` | Stock across warehouses for SKU |
| `PUT` | `/api/v1/inventory/variants/{variant}/warehouses/{warehouse}` | `api.v1.inventory.update` | Update on-hand / reserved stock |

---

## 6. Neon Serverless Postgres Setup & Deployment

### Step 1: Configure `.env` for Neon Connection Pooling
In your `.env` file, point to your Neon pooled host:

```ini
DB_CONNECTION=pgsql
DB_HOST=ep-example-pooler.ap-southeast-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=your_neon_password
DB_SSLMODE=require
```

### Step 2: PDO Emulated Prepares (Configured in `config/database.php`)
Neon uses PgBouncer in **Transaction Mode**. In `config/database.php` under `'pgsql'`, the following option has been pre-configured:

```php
'options' => [
    \PDO::ATTR_EMULATE_PREPARES => true,
],
```

### Step 3: Run Database Migrations
Execute the migrations to build all extensions, types, tables, and views:

```bash
php artisan migrate --force
```

### Step 4: Seed Initial Indian Fashion Catalog
Populate fashion brands, categories, attribute definitions, and products:

```bash
php artisan db:seed
```

---

## 7. Performance Queries & Examples

### 1. High-Speed Facet Search with `GIN (jsonb_path_ops)`
Filter for Red kurtas made of Silk:
```php
$products = Product::active()
    ->withBaseAttributes(['fabric' => 'Silk'])
    ->whereHas('variants', function ($q) {
        $q->withVariantOptions(['color' => 'Red']);
    })
    ->get();
```

### 2. Subtree Category Queries with `ltree`
Fetch all products under `womens.ethnic_wear` including Sarees, Anarkalis, and Salwar Suits in a single scan:
```php
$category = Category::where('slug', 'womens-ethnic-wear')->first();

$products = Product::active()
    ->whereHas('categories', function ($q) use ($category) {
        $q->descendantsOf($category->path);
    })
    ->get();
```

### 3. Atomic Inventory Reservation
Reserve 2 units of a variant across fulfillment priority order:
```php
use App\Actions\Inventory\ReserveInventoryAction;

$action = app(ReserveInventoryAction::class);
$inventoryLevel = $action->execute($variant, 2);
// Automatically increments quantity_reserved, quantity_available is computed instantly in DB!
```
