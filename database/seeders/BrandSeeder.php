<?php

namespace Database\Seeders;

use App\Helpers\UUID;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{

    public function run()
    {
        $brands = [
            'Nike',
            'Adidas',
            'Jordan',
            'Puma',
            'Yeezy',
            'Aerosoft',
            'Jajako'
        ];
        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'unique_code' => UUID::generate(),
                'brand_code' => UUID::BrandCode(),
            ]);
        }
    }
}