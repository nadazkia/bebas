<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categoryName = [
            [
                'name' => 'Sabun',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shampoo',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parfum',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Makanan',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categoryName as $value) {
            Category::create([
                'name' => $value['name'],
                'description' => $value['description'],
                'created_at' => $value['created_at'],
                'updated_at' => $value['updated_at'],
            ]);
        }
    }
}
