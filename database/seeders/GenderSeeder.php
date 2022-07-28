<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    public function run()
    {
        $genders = [
            'male',
            'female'
        ];
        foreach ($genders as $gender) {
            Gender::create(['name' => $gender]);
        }
    }
}