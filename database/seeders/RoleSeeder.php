<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin',]);
        $manager = Role::create(['name' => 'manager',]);
        Role::create(['name' => 'customer',]);

        $permissons = [
            'create-admin-user',
            'edit-admin-user',
            'create-manager-user',
            'edit-manager-user',
            'edit-admin-permission',
            'create-category',
            'edit-category',
            'update-category',
            'delete-category',
        ];
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(Permission::all());
        $manager->revokePermissionTo($permissons);
    }
}