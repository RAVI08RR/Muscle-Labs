@extends('layouts.app')

@section('title', 'Shopping Cart — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container">
        <h1 class="text-3xl font-extrabold text-white">Laboratory Reagent Cart</h1>
    </div>
</div>

<div class="section">
    <div class="container">
        @if(! $cart || $cart->lines->isEmpty())
            <div class="card p-12 text-center max-w-xl mx-auto">
                <svg class="w-16 h-16 text-[var(--color-text-muted)] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <h2 class="text-xl font-bold text-white mb-2">Your cart is currently empty</h2>
                <p class="text-sm text-[var(--color-text-secondary)] mb-6">Explore our high-purity UK stock research peptides and reagents.</p>
                <a href="{{ route('catalogue.index') }}" class="btn btn-primary">Browse Catalogue</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Lines Table -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="card p-6">
                        <div class="divide-y divide-[var(--color-border)]">
                            @foreach($cart->lines as $line)
                                @php
                                    $purchasable = $line->purchasable;
                                    $product = $purchasable?->product;
                                    $name = $product?->attribute_data->get('name')?->getValue() ?? 'Research Reagent';
                                    $price = $line->subTotal?->value ?? ($line->unitPrice?->value * $line->quantity);
                                @endphp
                                <div class="py-6 first:pt-0 last:pb-0 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-xl bg-[var(--color-bg-elevated)] border border-[var(--color-border)] flex items-center justify-center text-[var(--color-accent-light)] flex-shrink-0">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-white mb-1">{{ $name }}</h3>
                                            <div class="text-xs text-[var(--color-text-muted)] font-mono">SKU: {{ $purchasable?->sku }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end">
                                        <!-- Update Qty Form -->
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="line_id" value="{{ $line->id }}">
                                            <input type="number" name="quantity" value="{{ $line->quantity }}" min="1" class="input py-1 px-2 text-center w-16 text-xs">
                                            <button type="submit" class="btn btn-secondary btn-sm text-xs py-1 px-2">Update</button>
                                        </form>

                                        <div class="text-right">
                                            <div class="text-sm font-bold text-white font-display">£{{ number_format(($price) / 100, 2) }}</div>
                                        </div>

                                        <!-- Remove Line Form -->
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="line_id" value="{{ $line->id }}">
                                            <button type="submit" class="text-[var(--color-text-muted)] hover:text-red-400 transition p-1">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="space-y-6">
                    <div class="card p-6 space-y-4">
                        <h2 class="text-lg font-bold text-white border-b border-[var(--color-border)] pb-3">Order Summary</h2>

                        <div class="flex items-center justify-between text-sm text-[var(--color-text-secondary)]">
                            <span>Subtotal</span>
                            <span class="font-semibold text-white">£{{ number_format(($cart->subTotal?->value ?? 0) / 100, 2) }}</span>
                        </div>

                        <div class="flex items-center justify-between text-sm text-[var(--color-text-secondary)]">
                            <span>Royal Mail Tracked 24</span>
                            <span class="text-emerald-400 font-semibold">FREE</span>
                        </div>

                        <div class="border-t border-[var(--color-border)] pt-4 flex items-center justify-between">
                            <span class="text-base font-bold text-white">Total</span>
                            <span class="text-2xl font-bold text-white font-display">£{{ number_format(($cart->total?->value ?? $cart->subTotal?->value ?? 0) / 100, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg w-full mt-4">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
