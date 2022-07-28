<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
    }
}