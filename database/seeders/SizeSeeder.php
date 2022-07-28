<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{

    public function run()
    {
        $sizes[] = '';
        $j = 8;
        for ($i = 0; $i < 13; $i++) {
            $sizes[$i] = $j;
            $j += .5;
        }

        foreach ($sizes as $size) {
            Size::create(['name' => $size]);
        }
    }
}