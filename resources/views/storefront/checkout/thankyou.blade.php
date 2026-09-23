@extends('layouts.app')

@section('title', 'Order Placed — Muscle Labs UK')

@section('content')
<div class="section">
    <div class="container max-w-3xl text-center">
        <div class="card p-12 space-y-6">
            <div class="w-20 h-20 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 mx-auto animate-fade-in">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>

            <div>
                <span class="section-label">Order Confirmed</span>
                <h1 class="text-3xl font-extrabold text-white mt-1">Thank You for Your Order</h1>
                <p class="text-sm text-[var(--color-text-secondary)] mt-2">
                    Your research peptide order has been received and sent to our laboratory dispatch team.
                </p>
            </div>

            <div class="p-4 rounded-xl glass border border-violet-500/30 text-left space-y-2">
                <div class="text-xs text-[var(--color-text-muted)] font-mono">ORDER REFERENCE</div>
                <div class="text-2xl font-bold text-white font-display tracking-wider text-[var(--color-accent-light)]">{{ $order->reference }}</div>
                <div class="text-xs text-[var(--color-text-secondary)]">A tracking email will be sent once dispatched via Royal Mail Tracked 24.</div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a href="{{ route('order.track') }}" class="btn btn-secondary">
                    Track Your Order
                </a>
                <a href="{{ route('catalogue.index') }}" class="btn btn-primary">
                    Return to Shop
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
