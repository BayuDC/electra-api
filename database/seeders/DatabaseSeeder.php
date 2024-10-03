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


        $file = fopen(base_path("database/seeders/dummy/categories.csv"), "r");

        $first = true;
        while (($row = fgetcsv($file, 2000, ",")) !== false) {
            if (!$first) {
                Category::create([
                    "name" => $row['0'],
                    "slug" => $row['1'],
                ]);
            }
            $first = false;
        }

        fclose($file);

        $file = fopen(base_path("database/seeders/dummy/products.csv"), "r");

        $first = true;
        while (($row = fgetcsv($file, 2000, ",")) !== false) {
            if (!$first) {
                Product::create([
                    "name" => $row['0'],
                    "slug" => $row['1'],
                    "price" => $row['2'],
                    "unit" => $row['3'],
                    'category_id' => $row['4'],
                    "picture" => $row['5'],
                ]);
            }
            $first = false;
        }

        fclose($file);
    }
}
