@extends('layouts.app')

@section('title', 'Order confirmed')

@section('content')
    <x-card title="Salamat, {{ $order->customer->name }}!">
        <p>We've received your order <strong>#{{ $order->id }}</strong> — total
            <strong>₱{{ number_format($order->total_cents / 100, 2) }}</strong>, cash on delivery.</p>
        <p>We'll email you once it ships. You can keep browsing in the meantime.</p>
        <p><a class="btn" href="{{ route('products.index') }}">Back to products</a></p>
    </x-card>
@endsection
