@extends('layouts.app')

@section('title', 'Checkout — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">Secure Checkout</h1>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl">
        <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Form Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Contact Information -->
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-bold text-white border-b border-[var(--color-border)] pb-3">1. Contact & Laboratory Details</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="label">First Name *</label>
                            <input type="text" name="first_name" required value="{{ old('first_name') }}" class="input">
                        </div>
                        <div>
                            <label class="label">Last Name *</label>
                            <input type="text" name="last_name" required value="{{ old('last_name') }}" class="input">
                        </div>
                    </div>

                    <div>
                        <label class="label">Email Address (Order Confirmation) *</label>
                        <input type="email" name="email" required value="{{ old('email') }}" class="input">
                    </div>

                    <div>
                        <label class="label">Contact Telephone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="For delivery updates" class="input">
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-bold text-white border-b border-[var(--color-border)] pb-3">2. Delivery Address</h2>

                    <div>
                        <label class="label">Street Address *</label>
                        <input type="text" name="address" required value="{{ old('address') }}" placeholder="Building, street name..." class="input">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Town / City *</label>
                            <input type="text" name="city" required value="{{ old('city') }}" class="input">
                        </div>
                        <div>
                            <label class="label">Postcode *</label>
                            <input type="text" name="postcode" required value="{{ old('postcode') }}" placeholder="e.g. EC1A 1BB" class="input">
                        </div>
                    </div>

                    <div>
                        <label class="label">Country *</label>
                        <select name="country" required class="input">
                            <option value="GB" selected>United Kingdom</option>
                        </select>
                    </div>
                </div>

                <!-- Payment Method Notice -->
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-bold text-white border-b border-[var(--color-border)] pb-3">3. Payment Confirmation</h2>

                    <div class="flex items-center gap-3 p-4 rounded-xl bg-violet-500/10 border border-violet-500/30 text-sm text-[var(--color-text-secondary)]">
                        <svg class="w-6 h-6 text-[var(--color-accent-light)] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <div>
                            <span class="font-bold text-white block">SSL Encrypted Checkout</span>
                            Order reference will be generated and processed via secure gateway.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="space-y-6">
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-bold text-white border-b border-[var(--color-border)] pb-3">Order Summary</h2>

                    <div class="divide-y divide-[var(--color-border)] text-sm">
                        @foreach($cart->lines as $line)
                            @php
                                $name = $line->purchasable?->product?->attribute_data->get('name')?->getValue() ?? 'Reagent';
                                $price = $line->subTotal?->value ?? ($line->unitPrice?->value * $line->quantity);
                            @endphp
                            <div class="py-3 flex justify-between gap-2">
                                <div>
                                    <div class="text-white font-medium line-clamp-1">{{ $name }}</div>
                                    <div class="text-xs text-[var(--color-text-muted)]">Qty: {{ $line->quantity }}</div>
                                </div>
                                <span class="font-bold text-white">£{{ number_format(($price) / 100, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-[var(--color-border)] pt-4 space-y-2 text-sm text-[var(--color-text-secondary)]">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-white">£{{ number_format(($cart->subTotal?->value ?? 0) / 100, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-emerald-400">
                            <span>Royal Mail Tracked 24</span>
                            <span class="font-bold">FREE</span>
                        </div>
                        <div class="border-t border-[var(--color-border)] pt-3 flex justify-between text-lg font-bold text-white">
                            <span>Total</span>
                            <span class="font-display">£{{ number_format(($cart->total?->value ?? $cart->subTotal?->value ?? 0) / 100, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-full mt-4">
                        Complete Order & Pay
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
