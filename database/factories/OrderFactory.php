<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->numberBetween(300, 25000) * 10;
        $vat = (int) round($subtotal * 0.12);
        $shipping = $subtotal >= 500000 ? 0 : 9900;

        return [
            'customer_id' => Customer::factory(),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'subtotal_cents' => $subtotal,
            'vat_cents' => $vat,
            'shipping_cents' => $shipping,
            'total_cents' => $subtotal + $vat + $shipping,
            'placed_at' => fake()->dateTimeBetween('-18 months', 'now'),
        ];
    }
}
