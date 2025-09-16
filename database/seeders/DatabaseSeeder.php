<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class, // Seeder untuk membuat role & permission
            AdminUserSeeder::class,      // Seeder untuk membuat user admin & super-admin
        ]);

        // Anda bisa tetap menjalankan factory untuk membuat user biasa jika perlu
        // \App\Models\User::factory(10)->create();
    }
}
