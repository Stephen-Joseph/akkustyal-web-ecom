<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Models\Brand;
use App\Models\Category;
use App\Models\InventoryLevel;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantPrice;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCatalogSeeder extends Seeder
{
    /**
     * Seed a representative product catalog for an Indian fashion store.
     */
    public function run(): void
    {
        $warehouses = $this->seedWarehouses();
        $this->seedProducts($warehouses);
    }

    /**
     * Seed the three main Indian warehouses.
     *
     * @return list<Warehouse>
     */
    private function seedWarehouses(): array
    {
        $warehouseData = [
            [
                'code' => 'MUM-WH1',
                'name' => 'Mumbai Warehouse 1',
                'country_code' => 'IN',
                'state_code' => 'MH',
                'postal_code' => '400001',
                'address_details' => ['city' => 'Mumbai', 'street' => 'Lower Parel Industrial Area'],
                'priority' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'DEL-WH1',
                'name' => 'Delhi Warehouse 1',
                'country_code' => 'IN',
                'state_code' => 'DL',
                'postal_code' => '110001',
                'address_details' => ['city' => 'Delhi', 'street' => 'Okhla Industrial Area'],
                'priority' => 2,
                'is_active' => true,
            ],
            [
                'code' => 'BLR-WH1',
                'name' => 'Bangalore Warehouse 1',
                'country_code' => 'IN',
                'state_code' => 'KA',
                'postal_code' => '560001',
                'address_details' => ['city' => 'Bangalore', 'street' => 'Peenya Industrial Area'],
                'priority' => 3,
                'is_active' => true,
            ],
        ];

        $warehouses = [];

        foreach ($warehouseData as $data) {
            $warehouses[] = Warehouse::updateOrCreate(['code' => $data['code']], $data);
        }

        return $warehouses;
    }

    /**
     * Seed sample products with variants, prices, and inventory.
     *
     * @param list<Warehouse> $warehouses
     */
    private function seedProducts(array $warehouses): void
    {
        $fabindia = Brand::where('slug', 'fabindia')->first();
        $manyavar = Brand::where('slug', 'manyavar')->first();
        $biba = Brand::where('slug', 'biba')->first();

        $mensEthnic = Category::where('slug', 'mens-ethnic-wear')->first();
        $womensEthnic = Category::where('slug', 'womens-ethnic-wear')->first();
        $womensSarees = Category::where('slug', 'womens-sarees')->first();

        $productsData = [
            [
                'brand' => $fabindia,
                'categories' => [$mensEthnic],
                'product' => [
                    'name' => 'Classic Cotton Kurta',
                    'slug' => 'classic-cotton-kurta',
                    'product_type' => ProductType::Configurable,
                    'status' => ProductStatus::Active,
                    'short_description' => 'A timeless handwoven cotton kurta for everyday wear.',
                    'description' => 'Crafted from premium handwoven cotton, this classic kurta is perfect for casual and semi-formal occasions. Features traditional block prints and comfortable straight cut.',
                    'base_attributes' => ['fabric' => 'Cotton', 'occasion' => ['Casual', 'Festive'], 'neckline' => 'Collar'],
                    'seo_metadata' => ['title' => 'Classic Cotton Kurta | Fabindia', 'description' => 'Shop handwoven cotton kurtas'],
                    'published_at' => now(),
                ],
                'variants' => [
                    ['name' => 'M / White', 'sku' => 'FAB-KUR-M-WHT', 'options' => ['size' => 'M', 'color' => 'White'], 'msrp' => 2500, 'retail' => 1999],
                    ['name' => 'L / White', 'sku' => 'FAB-KUR-L-WHT', 'options' => ['size' => 'L', 'color' => 'White'], 'msrp' => 2500, 'retail' => 1999],
                    ['name' => 'XL / White', 'sku' => 'FAB-KUR-XL-WHT', 'options' => ['size' => 'XL', 'color' => 'White'], 'msrp' => 2500, 'retail' => 1999],
                    ['name' => 'M / Blue', 'sku' => 'FAB-KUR-M-BLU', 'options' => ['size' => 'M', 'color' => 'Blue'], 'msrp' => 2500, 'retail' => 1999],
                ],
            ],
            [
                'brand' => $manyavar,
                'categories' => [$mensEthnic],
                'product' => [
                    'name' => 'Royal Sherwani Set',
                    'slug' => 'royal-sherwani-set',
                    'product_type' => ProductType::Simple,
                    'status' => ProductStatus::Active,
                    'short_description' => 'An exquisite sherwani set for weddings and festivals.',
                    'description' => 'Adorned with intricate zari embroidery, this sherwani set is crafted from premium silk blend fabric. Includes matching churidar and dupatta.',
                    'base_attributes' => ['fabric' => 'Silk', 'occasion' => ['Wedding', 'Festive'], 'fit' => 'Regular'],
                    'seo_metadata' => ['title' => 'Royal Sherwani Set | Manyavar', 'description' => 'Luxury sherwanis for special occasions'],
                    'published_at' => now(),
                ],
                'variants' => [
                    ['name' => 'S / Gold', 'sku' => 'MAN-SHW-S-GLD', 'options' => ['size' => 'S', 'color' => 'Gold'], 'msrp' => 25000, 'retail' => 19999],
                    ['name' => 'M / Gold', 'sku' => 'MAN-SHW-M-GLD', 'options' => ['size' => 'M', 'color' => 'Gold'], 'msrp' => 25000, 'retail' => 19999, 'is_default' => true],
                    ['name' => 'L / Gold', 'sku' => 'MAN-SHW-L-GLD', 'options' => ['size' => 'L', 'color' => 'Gold'], 'msrp' => 25000, 'retail' => 19999],
                ],
            ],
            [
                'brand' => $biba,
                'categories' => array_filter([$womensEthnic, $womensSarees]),
                'product' => [
                    'name' => 'Printed Anarkali Suit',
                    'slug' => 'printed-anarkali-suit',
                    'product_type' => ProductType::Configurable,
                    'status' => ProductStatus::Active,
                    'short_description' => 'Vibrant floral printed anarkali suit for festive occasions.',
                    'description' => 'A graceful anarkali suit featuring vibrant floral prints on georgette fabric. The flared silhouette and complementary dupatta make it perfect for festive celebrations.',
                    'base_attributes' => ['fabric' => 'Georgette', 'occasion' => ['Festive', 'Party'], 'sleeve_type' => '3/4 Sleeve'],
                    'seo_metadata' => ['title' => 'Printed Anarkali Suit | Biba', 'description' => 'Festive anarkali suits for women'],
                    'published_at' => now(),
                ],
                'variants' => [
                    ['name' => 'XS / Coral', 'sku' => 'BIB-ANK-XS-COR', 'options' => ['size' => 'XS', 'color' => 'Coral'], 'msrp' => 5500, 'retail' => 3999, 'sale' => 2999],
                    ['name' => 'S / Coral', 'sku' => 'BIB-ANK-S-COR', 'options' => ['size' => 'S', 'color' => 'Coral'], 'msrp' => 5500, 'retail' => 3999, 'sale' => 2999],
                    ['name' => 'M / Coral', 'sku' => 'BIB-ANK-M-COR', 'options' => ['size' => 'M', 'color' => 'Coral'], 'msrp' => 5500, 'retail' => 3999, 'sale' => 2999, 'is_default' => true],
                    ['name' => 'L / Coral', 'sku' => 'BIB-ANK-L-COR', 'options' => ['size' => 'L', 'color' => 'Coral'], 'msrp' => 5500, 'retail' => 3999, 'sale' => 2999],
                ],
            ],
        ];

        foreach ($productsData as $productData) {
            if (! $productData['brand']) {
                continue;
            }

            $product = Product::updateOrCreate(
                ['slug' => $productData['product']['slug']],
                array_merge($productData['product'], ['brand_id' => $productData['brand']->id])
            );

            // Attach categories
            foreach ($productData['categories'] as $index => $category) {
                if ($category) {
                    $product->categories()->syncWithoutDetaching([
                        $category->id => ['is_primary' => $index === 0, 'sort_order' => $index],
                    ]);
                }
            }

            // Create variants with prices and inventory
            foreach ($productData['variants'] as $variantData) {
                $variant = ProductVariant::updateOrCreate(
                    ['sku' => $variantData['sku']],
                    [
                        'product_id' => $product->id,
                        'sku' => $variantData['sku'],
                        'name' => $variantData['name'],
                        'is_default' => $variantData['is_default'] ?? false,
                        'is_active' => true,
                        'track_inventory' => true,
                        'weight_grams' => 300,
                        'variant_options' => $variantData['options'],
                        'technical_specs' => [],
                        'media_gallery' => [],
                        'sort_order' => 0,
                    ]
                );

                VariantPrice::updateOrCreate(
                    ['variant_id' => $variant->id, 'currency_code' => 'INR'],
                    [
                        'msrp_price' => $variantData['msrp'],
                        'retail_price' => $variantData['retail'],
                        'sale_price' => $variantData['sale'] ?? null,
                        'sale_starts_at' => isset($variantData['sale']) ? now()->subDay() : null,
                        'sale_ends_at' => isset($variantData['sale']) ? now()->addDays(30) : null,
                        'tax_class' => 'standard',
                        'is_tax_inclusive' => true,
                    ]
                );

                foreach ($warehouses as $warehouse) {
                    InventoryLevel::updateOrCreate(
                        ['warehouse_id' => $warehouse->id, 'variant_id' => $variant->id],
                        [
                            'quantity_on_hand' => rand(10, 100),
                            'quantity_reserved' => 0,
                            'low_stock_threshold' => 5,
                        ]
                    );
                }
            }
        }
    }
}
