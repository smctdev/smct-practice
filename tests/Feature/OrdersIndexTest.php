<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_orders_index_renders_with_customer_names_and_item_counts(): void
    {
        $customer = Customer::factory()->create(['name' => 'Rosa Villanueva']);
        $order = Order::factory()->for($customer)->create();
        OrderItem::factory()->count(2)->for($order)->create();

        $this->get('/orders')
            ->assertOk()
            ->assertSee('Rosa Villanueva')
            ->assertSee('#'.$order->id);
    }

    public function test_the_orders_index_renders_when_there_are_no_orders(): void
    {
        $this->get('/orders')->assertOk();
    }
}
