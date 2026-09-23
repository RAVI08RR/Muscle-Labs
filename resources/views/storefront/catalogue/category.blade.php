@extends('layouts.app')

@section('title', ($category->attribute_data->get('name')?->getValue() ?? 'Category') . ' — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container">
        <span class="section-label">Category Filter</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mt-1 mb-2">
            {{ $category->attribute_data->get('name')?->getValue() }}
        </h1>
        <p class="text-[var(--color-text-secondary)] max-w-2xl text-sm">
            {{ $category->attribute_data->get('description')?->getValue() }}
        </p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
            @foreach($products as $product)
                @php
                    $variant = $product->variants->first();
                    $price = $variant?->prices->first();
                    $name = $product->attribute_data->get('name')?->getValue() ?? 'Peptide Reagent';
                    $purity = $product->attribute_data->get('purity')?->getValue() ?? '99.0%+';
                    $strength = $product->attribute_data->get('strength_size')?->getValue() ?? '5mg';
                    $slug = $product->urls->first()?->slug ?? 'product';
                @endphp
                <div class="product-card">
                    <div class="image-wrap flex items-center justify-center p-8 text-slate-700">
                        <svg class="w-24 h-24 text-[var(--color-accent)]/40 group-hover:scale-105 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        <span class="absolute top-3 left-3 badge badge-accent">{{ $purity }}</span>
                    </div>

                    <div class="info">
                        <div class="text-xs text-[var(--color-accent-light)] font-mono mb-1">{{ $strength }}</div>
                        <h3 class="text-base font-bold text-white mb-2 line-clamp-1">
                            <a href="{{ route('products.show', $slug) }}" class="hover:text-[var(--color-accent-light)] transition">
                                {{ $name }}
                            </a>
                        </h3>

                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-[var(--color-border)]">
                            <div>
                                <span class="text-xs text-[var(--color-text-muted)] block">From</span>
                                <span class="text-lg font-bold text-white font-display">£{{ number_format(($price?->price?->value ?? 2999) / 100, 2) }}</span>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="variant_id" value="{{ $variant?->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
