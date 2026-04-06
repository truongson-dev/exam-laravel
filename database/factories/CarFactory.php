<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mf_id' => \App\Models\Mf::inRandomOrder()->first()->id ?? \App\Models\Mf::factory(),
            'model' => fake()->asciify('car-****'),
            'produced_on' => fake()->date('Y-m-d'),
            'image' => fake()->randomElement(['car1.png', 'car2.png', 'car3.png', 'car4.png', 'car5.png']),
        ];
    }
}
