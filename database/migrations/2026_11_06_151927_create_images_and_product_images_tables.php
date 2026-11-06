<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        // 1. Clean up previous JSONB media column
        DB::statement('ALTER TABLE product_variants DROP COLUMN IF EXISTS media_gallery');

        // 2. Image Role Enum
        DB::statement("DO $$ BEGIN
            CREATE TYPE image_role_enum AS ENUM (
                'thumbnail',
                'gallery',
                'swatch',
                'lifestyle',
                'size_chart',
                'dimension_diagram',
                'video_poster'
            );
        EXCEPTION
            WHEN duplicate_object THEN NULL;
        END $$;");

        // 3. Master Media Registry (Physical File & CDN Metadata)
        DB::statement('CREATE TABLE IF NOT EXISTS images (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            storage_disk VARCHAR(32) NOT NULL DEFAULT \'s3\',
            external_asset_id VARCHAR(255),
            
            image_name VARCHAR(255) NOT NULL,
            original_filename VARCHAR(255),
            file_path TEXT NOT NULL,
            cdn_url TEXT NOT NULL,
            
            mime_type VARCHAR(64) NOT NULL DEFAULT \'image/webp\',
            extension VARCHAR(16) NOT NULL DEFAULT \'webp\',
            file_size_bytes INTEGER NOT NULL CHECK (file_size_bytes >= 0),
            
            width_px SMALLINT CHECK (width_px > 0),
            height_px SMALLINT CHECK (height_px > 0),
            aspect_ratio NUMERIC(5, 3) GENERATED ALWAYS AS (
                CASE WHEN height_px > 0 THEN ROUND(width_px::numeric / height_px::numeric, 3) ELSE NULL END
            ) STORED,
            
            focal_point JSONB NOT NULL DEFAULT \'{"x": 50, "y": 50}\'::jsonb,
            blurhash VARCHAR(120),
            responsive_urls JSONB NOT NULL DEFAULT \'{}\'::jsonb,
            
            default_alt_text VARCHAR(255),
            uploaded_by UUID,
            created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            deleted_at TIMESTAMPTZ
        )');

        // 4. Product & Variant Image Assignments (Junction Table)
        DB::statement('CREATE TABLE IF NOT EXISTS product_images (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            product_id UUID NOT NULL REFERENCES products(id) ON DELETE CASCADE,
            variant_id UUID REFERENCES product_variants(id) ON DELETE CASCADE,
            image_id UUID NOT NULL REFERENCES images(id) ON DELETE RESTRICT,
            
            image_name VARCHAR(255) NOT NULL,
            alt_text VARCHAR(255) NOT NULL,
            caption VARCHAR(500),
            
            image_role image_role_enum NOT NULL DEFAULT \'gallery\',
            option_match JSONB,
            
            is_primary BOOLEAN NOT NULL DEFAULT FALSE,
            is_active BOOLEAN NOT NULL DEFAULT TRUE,
            sort_order SMALLINT NOT NULL DEFAULT 0,
            
            created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
        )');

        // 5. Performance Indexes & Integrity Constraints
        DB::statement('CREATE INDEX IF NOT EXISTS idx_product_images_product_gallery 
            ON product_images (product_id, is_primary DESC, sort_order ASC) 
            WHERE is_active = TRUE');

        DB::statement('CREATE INDEX IF NOT EXISTS idx_product_images_variant_gallery 
            ON product_images (variant_id, is_primary DESC, sort_order ASC) 
            WHERE variant_id IS NOT NULL AND is_active = TRUE');

        DB::statement('CREATE INDEX IF NOT EXISTS idx_product_images_image_id 
            ON product_images (image_id)');

        DB::statement('CREATE INDEX IF NOT EXISTS idx_product_images_option_match_gin 
            ON product_images USING GIN (option_match jsonb_path_ops) 
            WHERE option_match IS NOT NULL');

        DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS idx_product_images_one_primary_per_product 
            ON product_images (product_id) 
            WHERE variant_id IS NULL AND is_primary = TRUE');

        DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS idx_product_images_one_primary_per_variant 
            ON product_images (variant_id) 
            WHERE variant_id IS NOT NULL AND is_primary = TRUE');

        DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS idx_product_images_unique_assignment 
            ON product_images (
                product_id, 
                COALESCE(variant_id, \'00000000-0000-0000-0000-000000000000\'::uuid), 
                image_id, 
                image_role
            )');

        // 6. Helper View: Resolved Gallery with Automatic Fallback
        DB::statement('CREATE OR REPLACE VIEW vw_resolved_variant_images AS
            SELECT 
                pv.id AS variant_id,
                pv.product_id,
                pi.id AS product_image_id,
                pi.image_id,
                COALESCE(pi.image_name, img.image_name) AS image_name,
                COALESCE(pi.alt_text, img.default_alt_text, pv.name) AS alt_text,
                pi.image_role,
                pi.is_primary,
                pi.sort_order,
                img.cdn_url,
                img.responsive_urls,
                img.width_px,
                img.height_px,
                img.aspect_ratio,
                img.blurhash,
                CASE 
                    WHEN pi.variant_id = pv.id THEN 1
                    WHEN pi.option_match IS NOT NULL AND pv.variant_options @> pi.option_match THEN 2
                    ELSE 3
                END AS match_priority
            FROM product_variants pv
            JOIN product_images pi ON pi.product_id = pv.product_id
            JOIN images img ON img.id = pi.image_id
            WHERE pi.is_active = TRUE
              AND img.deleted_at IS NULL
              AND (
                  pi.variant_id = pv.id
                  OR (pi.variant_id IS NULL AND pi.option_match IS NOT NULL AND pv.variant_options @> pi.option_match)
                  OR (pi.variant_id IS NULL AND pi.option_match IS NULL)
              )');
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_resolved_variant_images');
        DB::statement('DROP TABLE IF EXISTS product_images CASCADE');
        DB::statement('DROP TABLE IF EXISTS images CASCADE');
        DB::statement('DROP TYPE IF EXISTS image_role_enum');
        DB::statement("ALTER TABLE product_variants ADD COLUMN IF NOT EXISTS media_gallery JSONB DEFAULT '[]'::jsonb");
    }
};
