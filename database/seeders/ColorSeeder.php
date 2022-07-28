<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $colors = [
            '#000000',
            '#C0C0C0',
            '#808080',
            '#FFFFFF',
            '#FF0000'
        ];

        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }
    }
}