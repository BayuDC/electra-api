<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@localhost',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        Category::create([
            'name' => 'Resistor',
            'slug' => 'resistor',
        ]);

        Product::create([
            'name' => 'Resistor 1K Ohm',
            'slug' => 'resistor-1k-ohm',
            'price' => 100,
            'unit' => 'pcs',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/3_Resistors.jpg/640px-3_Resistors.jpg',
            'description' => '',
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Resistor 1.2K Ohm',
            'slug' => 'resistor-1k2-ohm',
            'price' => 100,
            'unit' => 'pcs',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/3_Resistors.jpg/640px-3_Resistors.jpg',
            'description' => '',
            'category_id' => 1,
        ]);
    }
}
