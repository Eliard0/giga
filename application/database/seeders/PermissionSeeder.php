<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'edit articles']);
        Permission::firstOrCreate(['name' => 'delete articles']);
        Permission::firstOrCreate(['name' => 'publish articles']);
        Permission::firstOrCreate(['name' => 'unpublish articles']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::firstOrCreate(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        $role = Role::firstOrCreate(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}