<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\State;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // State::factory(30)->create();
        // City::factory(50)->create();
        // Category::factory(16)->create();
        // SubCategory::factory(30)->create();
        $this->call([
            UserSeeder::class,
            // VendorSeeder::class,
            // ServiceSeeder::class
        ]);
    }
}
