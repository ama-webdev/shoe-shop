<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user = User::create([
            'name' => 'Aye Min Aung',
            'email' => 'webdev.ama@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'ACTIVE',
        ]);
        $admin_user->assignRole(['admin', 'manager', 'customer']);

        $manager_user = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'ACTIVE',
        ]);
        $manager_user->assignRole(['manager', 'customer']);

        $customer_user = User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'ACTIVE',
        ]);
        $customer_user->assignRole(['customer']);
    }
}