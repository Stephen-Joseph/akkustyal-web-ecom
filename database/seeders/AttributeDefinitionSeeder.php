<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\AttributeDefinition;
use Illuminate\Database\Seeder;

class AttributeDefinitionSeeder extends Seeder
{
    /**
     * Seed fashion-specific attribute definitions for the Indian market.
     */
    public function run(): void
    {
        $attributes = [
            [
                'code' => 'size',
                'name' => 'Size',
                'data_type' => AttributeType::Select,
                'unit' => null,
                'allowed_values' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL'],
                'is_variant_axis' => true,
                'is_filterable' => true,
                'is_searchable' => false,
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'code' => 'color',
                'name' => 'Color',
                'data_type' => AttributeType::Color,
                'unit' => null,
                'allowed_values' => null,
                'is_variant_axis' => true,
                'is_filterable' => true,
                'is_searchable' => true,
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'code' => 'fabric',
                'name' => 'Fabric',
                'data_type' => AttributeType::Select,
                'unit' => null,
                'allowed_values' => ['Cotton', 'Silk', 'Linen', 'Chiffon', 'Polyester', 'Rayon', 'Georgette', 'Wool', 'Denim'],
                'is_variant_axis' => false,
                'is_filterable' => true,
                'is_searchable' => true,
                'is_required' => false,
                'sort_order' => 3,
            ],
            [
                'code' => 'fit',
                'name' => 'Fit',
                'data_type' => AttributeType::Select,
                'unit' => null,
                'allowed_values' => ['Regular', 'Slim', 'Relaxed', 'Oversized', 'Tailored', 'Straight'],
                'is_variant_axis' => false,
                'is_filterable' => true,
                'is_searchable' => false,
                'is_required' => false,
                'sort_order' => 4,
            ],
            [
                'code' => 'occasion',
                'name' => 'Occasion',
                'data_type' => AttributeType::Multiselect,
                'unit' => null,
                'allowed_values' => ['Casual', 'Formal', 'Festive', 'Party', 'Wedding', 'Office', 'Beach', 'Sports'],
                'is_variant_axis' => false,
                'is_filterable' => true,
                'is_searchable' => true,
                'is_required' => false,
                'sort_order' => 5,
            ],
            [
                'code' => 'sleeve_type',
                'name' => 'Sleeve Type',
                'data_type' => AttributeType::Select,
                'unit' => null,
                'allowed_values' => ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless', '3/4 Sleeve', 'Cap Sleeve'],
                'is_variant_axis' => false,
                'is_filterable' => true,
                'is_searchable' => false,
                'is_required' => false,
                'sort_order' => 6,
            ],
            [
                'code' => 'neckline',
                'name' => 'Neckline',
                'data_type' => AttributeType::Select,
                'unit' => null,
                'allowed_values' => ['Round Neck', 'V-Neck', 'Collar', 'Mandarin', 'Boat Neck', 'Square Neck', 'Off-Shoulder'],
                'is_variant_axis' => false,
                'is_filterable' => true,
                'is_searchable' => false,
                'is_required' => false,
                'sort_order' => 7,
            ],
            [
                'code' => 'weight',
                'name' => 'Weight',
                'data_type' => AttributeType::Number,
                'unit' => 'g',
                'allowed_values' => null,
                'is_variant_axis' => false,
                'is_filterable' => false,
                'is_searchable' => false,
                'is_required' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($attributes as $attribute) {
            AttributeDefinition::updateOrCreate(
                ['code' => $attribute['code']],
                $attribute
            );
        }
    }
}
