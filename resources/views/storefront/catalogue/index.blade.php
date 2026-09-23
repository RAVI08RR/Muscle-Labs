@extends('layouts.app')

@section('title', 'Buy Research Peptides UK — Catalogue | Muscle Labs')
@section('meta_description', 'Browse full catalogue of high-purity research peptides, GLP-1 agonists, BPC-157, TB-500, and GH secretagogues.')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">Research Peptide Shop</h1>
        <p class="text-[var(--color-text-secondary)] max-w-2xl text-sm">
            High-purity lyophilized peptides for laboratory in-vitro analysis. All products supplied with verified batch HPLC purity reports.
        </p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="space-y-6">
                <form action="{{ route('catalogue.index') }}" method="GET" class="card p-6 space-y-6">
                    <!-- Search Input -->
                    <div>
                        <label class="label">Search Reagents</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="e.g. BPC-157, Semaglutide..." class="input">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="label">Reagent Category</label>
                        <select name="category" class="input">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                @php $catSlug = $cat->urls->first()?->slug; @endphp
                                <option value="{{ $catSlug }}" {{ request('category') == $catSlug ? 'selected' : '' }}>
                                    {{ $cat->attribute_data->get('name')?->getValue() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div>
                        <label class="label">Sort By</label>
                        <select name="sort" class="input">
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        Apply Filters
                    </button>

                    @if(request()->anyFilled(['q', 'category', 'sort']))
                        <a href="{{ route('catalogue.index') }}" class="btn btn-secondary w-full text-xs text-center block">
                            Clear Filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- Product Grid -->
            <div class="lg:col-span-3">
                @if($products->isEmpty())
                    <div class="card p-12 text-center">
                        <svg class="w-12 h-12 text-[var(--color-text-muted)] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <h3 class="text-lg font-bold text-white mb-1">No products found</h3>
                        <p class="text-xs text-[var(--color-text-secondary)] mb-6">Try adjusting your search terms or filters.</p>
                        <a href="{{ route('catalogue.index') }}" class="btn btn-secondary btn-sm">Reset Filters</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger">
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
                                    {{-- Image Area --}}
                                    <div class="image-wrap relative aspect-square flex items-center justify-center bg-[var(--color-bg-elevated)] overflow-hidden">
                                        <img src="{{ $product->media->first()?->getUrl() ?: asset('images/product-vial-dummy.png') }}"
                                             alt="{{ $name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        <span class="absolute top-3 left-3 badge badge-accent z-10">99%+ Purity</span>
                                    </div>

                                    {{-- Info Body --}}
                                    <div class="info p-4">
                                        <div class="flex items-center justify-between gap-2 mb-1.5">
                                            <a href="{{ route('products.show', $slug) }}" class="font-extrabold text-base text-white hover:text-[var(--color-accent-light)] transition line-clamp-1">
                                                {{ $name }}
                                            </a>
                                            <span class="shrink-0 px-2 py-0.5 rounded text-xs font-mono font-semibold text-[var(--color-text-secondary)]" style="background: rgba(255,255,255,0.06);">
                                                {{ $strength }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-[var(--color-text-secondary)] line-clamp-1 mb-2">
                                            Synthetic Research Compound
                                        </p>
                                        <div class="flex items-center gap-1.5 mb-2">
                                            <div class="flex items-center text-amber-400 text-xs">
                                                ★ ★ ★ ★ ★
                                            </div>
                                            <span class="text-xs text-[var(--color-text-muted)] font-medium">4.9 (48)</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Footer --}}
                                <div class="px-4 pb-4 pt-3 flex items-center justify-between border-t border-[var(--color-border)] bg-black/10">
                                    <span class="text-lg font-extrabold text-white font-display">
                                        £{{ number_format(($price?->price?->value ?? 2999) / 100, 2) }}
                                    </span>

                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $variant?->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                            </svg>
                                            <span>Add to Cart</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
