<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            // A chunk of walk-in customers never left a mobile number.
            'phone' => fake()->boolean(85) ? '09'.fake()->numerify('#########') : null,
            'city' => fake()->randomElement([
                'Quezon City', 'Cebu City', 'Davao City', 'Makati', 'Iloilo City',
                'Cagayan de Oro', 'Bacolod', 'Taguig', 'Pasig', 'Mandaue',
                'Baguio', 'General Santos', 'Zamboanga City', 'Dumaguete',
            ]),
        ];
    }
}
