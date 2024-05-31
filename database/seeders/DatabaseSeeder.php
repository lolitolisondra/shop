<?php

namespace Database\Seeders;

use App\Models\User;
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
            RoleSeeder::class,
            CategorySeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@shop.com',
            'password' => 'user123',
        ])
        ->assignRole('User');

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@shop.com',
            'password' => 'admin123',
        ])
        ->assignRole('Administrator');

    
    }
}
