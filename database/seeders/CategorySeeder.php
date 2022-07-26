<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $categories = [
            'Everyday Sneakers',
            'Running Shoes',
            'Sandals',
            'Slip-Ons',
            'Water-Repellent Sneakers',
            'Hiking Shoes',
            'Flats',
            'Water-Repellent Sneakers',
            'High Tops',
            'Slippers',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}