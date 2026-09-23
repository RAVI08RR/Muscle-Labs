@extends('layouts.app')

@section('title', 'Customer Account Dashboard — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">Laboratory Account Dashboard</h1>
        <p class="text-xs text-[var(--color-text-secondary)] mt-1">Welcome back, {{ $user->name }} ({{ $user->email }})</p>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('account.orders') }}" class="card p-6 hover:border-[var(--color-accent)] transition">
                <div class="text-2xl font-bold text-white font-display mb-1">{{ $recentOrders->count() }}</div>
                <div class="text-xs text-[var(--color-text-muted)] font-medium uppercase tracking-wider">Recent Orders</div>
            </a>

            <a href="{{ route('account.addresses') }}" class="card p-6 hover:border-[var(--color-accent)] transition">
                <div class="text-2xl font-bold text-white font-display mb-1">Addresses</div>
                <div class="text-xs text-[var(--color-text-muted)] font-medium uppercase tracking-wider">Delivery Records</div>
            </a>

            <a href="{{ route('account.profile.edit') }}" class="card p-6 hover:border-[var(--color-accent)] transition">
                <div class="text-2xl font-bold text-white font-display mb-1">Profile</div>
                <div class="text-xs text-[var(--color-text-muted)] font-medium uppercase tracking-wider">Account Settings</div>
            </a>
        </div>

        <div class="card p-6">
            <h3 class="text-lg font-bold text-white mb-4 border-b border-[var(--color-border)] pb-3">Recent Laboratory Orders</h3>

            @if($recentOrders->isEmpty())
                <p class="text-xs text-[var(--color-text-secondary)] py-4 text-center">No orders found.</p>
            @else
                <div class="divide-y divide-[var(--color-border)] text-sm">
                    @foreach($recentOrders as $order)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-bold text-white">{{ $order->reference }}</div>
                                <div class="text-xs text-[var(--color-text-muted)]">{{ $order->placed_at?->format('M d, Y') }}</div>
                            </div>
                            <span class="badge badge-accent">{{ $order->status }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
