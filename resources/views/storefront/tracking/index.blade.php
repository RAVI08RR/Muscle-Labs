@extends('layouts.app')

@section('title', 'Track Order — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-xl text-center">
        <h1 class="text-3xl font-extrabold text-white">Order Tracking</h1>
        <p class="text-xs text-[var(--color-text-secondary)] mt-2">Enter your order reference number (e.g. ML-XXXXXX) and order email to check live dispatch status.</p>
    </div>
</div>

<div class="section">
    <div class="container max-w-xl">
        <div class="card p-8">
            <form action="{{ route('order.track.lookup') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="label">Order Reference Number *</label>
                    <input type="text" name="reference" required placeholder="ML-12345678" value="{{ old('reference') }}" class="input font-mono">
                </div>

                <div>
                    <label class="label">Email Address *</label>
                    <input type="email" name="email" required placeholder="Email used at checkout" value="{{ old('email') }}" class="input">
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-full">
                    Track Shipment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
