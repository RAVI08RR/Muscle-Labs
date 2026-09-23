@extends('layouts.app')

@section('title', 'My Orders — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">Order History</h1>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl">
        <div class="card p-6">
            @if($orders->isEmpty())
                <p class="text-xs text-[var(--color-text-secondary)] py-8 text-center">You have placed no orders yet.</p>
            @else
                <div class="divide-y divide-[var(--color-border)] text-sm">
                    @foreach($orders as $order)
                        <div class="py-4 flex items-center justify-between">
                            <div>
                                <div class="font-bold text-white text-base">{{ $order->reference }}</div>
                                <div class="text-xs text-[var(--color-text-muted)]">Placed {{ $order->placed_at?->format('M d, Y H:i') }}</div>
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="badge badge-success">{{ $order->status }}</span>
                                <a href="{{ route('account.orders.show', $order->reference) }}" class="btn btn-secondary btn-sm">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
