<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $userRole = Role::create(['name' => 'User']);

        Permission::create(['name' => 'manage products']);
        Permission::create(['name' => 'manage categories']);
        Permission::create(['name' => 'manage users']);

        $adminRole->givePermissionTo(['manage products', 'manage categories', 'manage users']);
        $userRole->givePermissionTo(['manage products', 'manage categories']);
    }
}
