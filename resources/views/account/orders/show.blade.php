@extends('layouts.app')

@section('title', "Order {$order->reference} — Muscle Labs UK")

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">Order Details: {{ $order->reference }}</h1>
        <div class="text-xs text-[var(--color-text-muted)] mt-1">Placed {{ $order->placed_at?->format('M d, Y H:i') }}</div>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl space-y-6">
        <div class="card p-6">
            <h3 class="text-lg font-bold text-white mb-4 border-b border-[var(--color-border)] pb-3">Reagent Items</h3>
            <div class="divide-y divide-[var(--color-border)] text-sm">
                @foreach($order->lines as $line)
                    @php
                        $name = $line->purchasable?->product?->attribute_data->get('name')?->getValue() ?? 'Reagent';
                        $price = $line->subTotal?->value ?? ($line->unitPrice?->value * $line->quantity);
                    @endphp
                    <div class="py-3 flex justify-between">
                        <div>
                            <div class="text-white font-medium">{{ $name }}</div>
                            <div class="text-xs text-[var(--color-text-muted)]">Qty: {{ $line->quantity }}</div>
                        </div>
                        <div class="font-bold text-white">£{{ number_format(($price) / 100, 2) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
