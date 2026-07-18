<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $line = fake()->randomElement([
            'Rice Cooker', 'Electric Fan', 'Flat Iron', 'Blender', 'Water Dispenser',
            'Gas Stove', 'Airpot', 'Wall Clock', 'Desk Lamp', 'Storage Box',
            'Ceiling Fan', 'Electric Kettle', 'Toaster', 'Ironing Board', 'Floor Mat',
        ]);

        $style = fake()->randomElement([
            'Stainless', 'Compact', 'Heavy-Duty', 'Classic', 'Portable',
            'Premium', 'Everyday', 'Two-Tone',
        ]);

        return [
            'name' => "{$style} {$line}",
            'sku' => strtoupper(fake()->unique()->bothify('??-####')),
            'price_cents' => fake()->numberBetween(199, 12999) * 100,
            'description' => fake()->sentence(10),
        ];
    }
}
