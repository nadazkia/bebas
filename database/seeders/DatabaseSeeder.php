<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
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
            CategorySeeder::class,
        ]);

        User::create([
            'name' => 'Admin Sudah Siap',
            'email' => 'admin@sudahsiap.com',
            'password' => bcrypt('12345678')
        ]);

        Brand::factory(15)->create();

        // Category::factory(5)->create();

        // Get all the roles attaching up to 3 random roles to each user
        $category = Category::all();

        // Populate the pivot table
        // Brand::all()->each(function ($brand) use ($category) {
        //     $brand->categories()->attach(
        //         $category->random(rand(1, 5))->pluck('id')->toArray()
        //     );
        // });

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
