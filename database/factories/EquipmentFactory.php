<?php

namespace Database\Factories;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    public function definition(): array
    {
        $category = fake()->randomElement([
            'Camera',
            'Audio',
            'Lighting',
            'Event',
            'Outdoor',
            'Tools',
        ]);

        return [
            'name' => fake()->words(3, true),

            'description' => fake()->sentence(12),

            'price' => fake()->randomElement([
                50000,
                75000,
                100000,
                125000,
                150000,
                200000,
                250000,
                300000,
            ]),

            'stock' => fake()->numberBetween(1, 10),

            'category' => $category,

            'picture' => null,
        ];
    }
}
