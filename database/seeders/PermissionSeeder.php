<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissons = [
            'create-admin-user',
            'edit-admin-user',
            'create-manager-user',
            'edit-manager-user',
            'create-customer-user',
            'edit-customer-user',
            'edit-admin-permission',
            'edit-manager-permission',
            'edit-customer-permission',
            'create-category',
            'edit-category',
            'update-category',
            'delete-category',
            'create-product',
            'edit-product',
            'update-product',
            'delete-product',
        ];

        foreach ($permissons as $permisson) {
            Permission::create(['name' => $permisson]);
        }
    }
}