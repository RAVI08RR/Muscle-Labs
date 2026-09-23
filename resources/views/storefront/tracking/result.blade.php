@extends('layouts.app')

@section('title', "Order {$order->reference} Status — Muscle Labs UK")

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-3xl">
        <span class="section-label">Order Lookup</span>
        <h1 class="text-3xl font-extrabold text-white mt-1">Reference: {{ $order->reference }}</h1>
        <div class="mt-2 flex items-center gap-3">
            <span class="badge badge-success">Status: {{ ucfirst(str_replace('-', ' ', $order->status)) }}</span>
            <span class="text-xs text-[var(--color-text-muted)]">Placed {{ $order->placed_at?->format('M d, Y H:i') }}</span>
        </div>
    </div>
</div>

<div class="section">
    <div class="container max-w-3xl space-y-8">
        <!-- Order Progress Timeline -->
        <div class="card p-6">
            <h3 class="text-lg font-bold text-white mb-6">Fulfillment Timeline</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="p-4 rounded-xl glass border border-emerald-500/30">
                    <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 font-bold mx-auto mb-2 flex items-center justify-center">1</div>
                    <div class="text-sm font-bold text-white">Payment Verified</div>
                    <div class="text-xs text-[var(--color-text-muted)]">Order received</div>
                </div>

                <div class="p-4 rounded-xl glass border border-violet-500/30">
                    <div class="w-8 h-8 rounded-full bg-violet-500/20 text-[var(--color-accent-light)] font-bold mx-auto mb-2 flex items-center justify-center">2</div>
                    <div class="text-sm font-bold text-white">Lab Preparation</div>
                    <div class="text-xs text-[var(--color-text-muted)]">Thermal packing</div>
                </div>

                <div class="p-4 rounded-xl glass border border-[var(--color-border)]">
                    <div class="w-8 h-8 rounded-full bg-slate-800 text-[var(--color-text-muted)] font-bold mx-auto mb-2 flex items-center justify-center">3</div>
                    <div class="text-sm font-bold text-white">Royal Mail Dispatch</div>
                    <div class="text-xs text-[var(--color-text-muted)]">Tracked 24 Delivery</div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card p-6">
            <h3 class="text-lg font-bold text-white mb-4">Reagent Items</h3>
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
