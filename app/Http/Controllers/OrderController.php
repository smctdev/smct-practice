<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Staff-facing list of every order on record.
     */
    public function index()
    {
        // planted for S1: the N+1 — no eager loading here, and the view reads
        // $order->customer->name and $order->items->count() on every row.
        $orders = Order::latest('placed_at')->get();

        return view('orders.index', ['orders' => $orders]);
    }
}
