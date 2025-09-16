<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // === Buat Permissions untuk Berita ===
        Permission::create(['name' => 'view berita']);
        Permission::create(['name' => 'create berita']);
        Permission::create(['name' => 'edit berita']);
        Permission::create(['name' => 'delete berita']);

        // === Buat Permissions untuk User ===
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);


        // === Buat Role Admin & Berikan Permission Berita ===
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view berita',
            'create berita',
            'edit berita',
            'delete berita',
        ]);

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}