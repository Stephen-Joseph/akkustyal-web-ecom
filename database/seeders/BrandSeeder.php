<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Seed Indian fashion brands into the brands table.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Fabindia',
                'slug' => 'fabindia',
                'website_url' => 'https://www.fabindia.com',
                'is_active' => true,
            ],
            [
                'name' => 'Manyavar',
                'slug' => 'manyavar',
                'website_url' => 'https://www.manyavar.com',
                'is_active' => true,
            ],
            [
                'name' => 'W for Woman',
                'slug' => 'w-for-woman',
                'website_url' => 'https://www.wforwoman.com',
                'is_active' => true,
            ],
            [
                'name' => 'Global Desi',
                'slug' => 'global-desi',
                'website_url' => 'https://www.globaldesi.in',
                'is_active' => true,
            ],
            [
                'name' => 'Biba',
                'slug' => 'biba',
                'website_url' => 'https://www.biba.in',
                'is_active' => true,
            ],
            [
                'name' => 'FabAlley',
                'slug' => 'faballey',
                'website_url' => 'https://www.faballey.com',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['slug' => $brand['slug']], $brand);
        }
    }
}
