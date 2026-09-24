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
                <div class="product-card group flex flex-col justify-between">
                    <div>
                        <a href="{{ route('products.show', $slug) }}" class="image-wrap relative aspect-square flex items-center justify-center bg-[var(--color-bg-elevated)] overflow-hidden block">
                            <img src="{{ $product->media->first()?->getUrl() ?: asset('images/product-vial-dummy.png') }}"
                                 alt="{{ $name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-3 left-3 badge badge-accent z-10">{{ $purity }}</span>
                        </a>

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
