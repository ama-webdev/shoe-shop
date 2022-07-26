<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Aye Min Aung',
            'email' => 'webdev.ama@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'ACTIVE',
        ]);
        $user->assignRole(['admin', 'manager', 'customer']);
    }
}