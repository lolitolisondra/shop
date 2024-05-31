<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['name' => 'Beauty and personal care', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beverages', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DIY and hardware', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electronics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion and apparel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Food', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Furniture', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Luxury goods', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Media', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toys and hobbies', 'created_at' => now(), 'updated_at' => now()],
        ];

        Category::insert($categories);
    }
}
