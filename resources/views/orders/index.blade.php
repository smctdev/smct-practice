@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <h1>Orders</h1>
    <p class="page-note">{{ number_format($orders->count()) }} orders on record, newest first.</p>

    <x-card>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th class="num">Total</th>
                    <th>Status</th>
                    <th>Placed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        {{-- planted for S1: the N+1 — customer and items are loaded per row --}}
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->items->count() }}</td>
                        <td class="num">₱{{ number_format($order->total_cents / 100, 2) }}</td>
                        <td><span class="badge badge-{{ $order->status->value }}">{{ $order->status->label() }}</span></td>
                        <td>{{ $order->placed_at->format('M j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection
