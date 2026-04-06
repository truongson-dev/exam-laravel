<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Command: php artisan db:seed --class=RestaurantSeeder
     */
    public function run(): void
    {
        // Clear existing records first
        Restaurant::truncate();

        // Create 10 random records
        Restaurant::factory()->count(10)->create();

        $this->command->info('✅  Seeded 10 restaurant records.');
    }
}