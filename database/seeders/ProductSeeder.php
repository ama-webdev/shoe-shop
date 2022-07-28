<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Size;
use App\Helpers\UUID;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $detail = '';
        $d_rand = rand(2, 5);
        for ($i = 0; $i < $d_rand; $i++) {
            $result = '<li>' . $faker->text . '</li>';
            $detail .= $result;
        }

        for ($i = 0; $i < 20; $i++) {
            $result = [
                'name' => $faker->word,
                'unique_code' => UUID::generate(),
                'product_code' => UUID::ProductCode(),
                'price' => rand(5000, 10000),
                'detail' => '<ul>' . $detail . '</ul>',
                'image' => 'images/products/product.jpg',
                'category_id' => Category::all()->random()->id,
                'gender_id' => Gender::all()->random()->id,
                'brand_id' => Brand::all()->random()->id,
            ];
            $product = Product::create($result);

            $c_rand = rand(1, count(Color::all()));
            $s_rand = rand(1, count(Product::all()));

            foreach (Color::limit($c_rand)->inRandomOrder()->get() as $color) {
                $product->colors()->attach($color->id);
            }
            foreach (Size::limit($s_rand)->inRandomOrder()->get() as $size) {
                $product->sizes()->attach($size->id);
            }
        }
    }
}