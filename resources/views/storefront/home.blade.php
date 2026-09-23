@extends('layouts.app')

@section('title', 'Buy Premium Research Peptides UK | Muscle Labs')
@section('meta_description', 'UK-based supplier of premium research peptides. 99%+ purity verified by third-party certificates of analysis (COA). BPC-157, TB-500, GHK-CU and more. Fast UK shipping.')

@section('content')
{{-- ══════════════════════════════════════
     1. HERO SECTION (Flex Peptides Layout)
     ══════════════════════════════════════ --}}
<section class="relative overflow-hidden py-20 lg:py-32 border-b border-[var(--color-border)]" style="background: radial-gradient(circle at 50% 20%, #151433 0%, var(--color-bg-base) 70%);">
    {{-- Ambient Ambient Glow Effects --}}
    <div class="hero-glow w-[600px] h-[600px] bg-[var(--color-accent)] opacity-20 -top-40 -left-40"></div>
    <div class="hero-glow w-[500px] h-[500px] bg-[var(--color-cyan)] opacity-15 top-1/2 -right-40"></div>

    {{-- Background Grid Overlay --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px); background-size: 24px 24px;"></div>

    <div class="container relative z-10">
        <div class="max-w-3xl">
            {{-- Top Badge --}}
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass border border-violet-500/30 text-xs font-semibold uppercase tracking-wider text-[var(--color-accent-light)] mb-8 animate-fade-in">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>UK-Based Research Peptide Supplier</span>
            </div>

            {{-- Headline --}}
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-6 leading-[1.08]" style="font-family: var(--font-display);">
                Precision peptides, <br>
                <span class="gradient-text">verified by science</span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg sm:text-xl text-[var(--color-text-secondary)] mb-10 leading-relaxed font-normal">
                99%+ purity on every batch, independently verified by HPLC/MS with a published Certificate of Analysis. Supplied to laboratories, universities and research organisations across the UK for in-vitro study.
            </p>

            {{-- Call To Action Buttons --}}
            <div class="flex flex-wrap items-center gap-4 mb-16">
                <a href="{{ route('catalogue.index') }}" class="btn btn-primary btn-lg group">
                    <span>Shop Peptides</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ route('page.show', 'quality-coa') }}" class="btn btn-secondary btn-lg">
                    Our Quality Standards
                </a>
            </div>

            {{-- Stat Metrics Grid (Flex Peptides style) --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-8 border-t border-[var(--color-border)]">
                <div class="border-l-2 border-[var(--color-accent)] pl-4">
                    <div class="text-3xl font-extrabold text-white font-display">99%+</div>
                    <div class="text-xs text-[var(--color-text-muted)] uppercase tracking-wider font-semibold mt-1">Verified Purity</div>
                </div>
                <div class="border-l-2 border-[var(--color-accent)] pl-4">
                    <div class="text-3xl font-extrabold text-white font-display">20+</div>
                    <div class="text-xs text-[var(--color-text-muted)] uppercase tracking-wider font-semibold mt-1">Research Compounds</div>
                </div>
                <div class="border-l-2 border-[var(--color-accent)] pl-4">
                    <div class="text-3xl font-extrabold text-white font-display">100%</div>
                    <div class="text-xs text-[var(--color-text-muted)] uppercase tracking-wider font-semibold mt-1">Batch COA Coverage</div>
                </div>
                <div class="border-l-2 border-[var(--color-accent)] pl-4">
                    <div class="text-3xl font-extrabold text-white font-display">1-3 Days</div>
                    <div class="text-xs text-[var(--color-text-muted)] uppercase tracking-wider font-semibold mt-1">UK Tracked Delivery</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     2. WHY CHOOSE MUSCLE LABS (4-Grid Features)
     ══════════════════════════════════════ --}}
<section class="py-14 border-b border-[var(--color-border)]" style="background: var(--color-bg-surface);">
    <div class="container">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
            {{-- Feature 1: Purity --}}
            <div class="card p-6 flex flex-col items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center text-[var(--color-accent-light)]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">99%+ Purity</h3>
                    <p class="text-sm text-[var(--color-text-secondary)] leading-relaxed">Every batch independently tested and verified before release.</p>
                </div>
            </div>

            {{-- Feature 2: COA --}}
            <div class="card p-6 flex flex-col items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">COA on Every Product</h3>
                    <p class="text-sm text-[var(--color-text-secondary)] leading-relaxed">Third-party certificates of analysis published per batch.</p>
                </div>
            </div>

            {{-- Feature 3: Fast UK Shipping --}}
            <div class="card p-6 flex flex-col items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0C2.678 5.577 2.25 6.057 2.25 6.625v7.625c0 .621.504 1.125 1.125 1.125h1.125"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">Fast UK Shipping</h3>
                    <p class="text-sm text-[var(--color-text-secondary)] leading-relaxed">Dispatched quickly from our UK facility, tracked end to end.</p>
                </div>
            </div>

            {{-- Feature 4: Research Grade --}}
            <div class="card p-6 flex flex-col items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5.032 14.47A4.5 4.5 0 008.214 21.75h7.572a4.5 4.5 0 003.182-7.28L14.909 10.41a2.25 2.25 0 01-.659-1.591V3.104"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">Research Grade</h3>
                    <p class="text-sm text-[var(--color-text-secondary)] leading-relaxed">Lyophilized for maximum stability and long shelf life.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     3. BEST SELLERS PRODUCT GRID (Flex Peptides Layout)
     ══════════════════════════════════════ --}}
<section class="section border-b border-[var(--color-border)]">
    <div class="container">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="section-label">Most Requested</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2">Best Sellers</h2>
                <p class="text-sm text-[var(--color-text-secondary)] mt-1">Our most popular research compounds, restocked weekly</p>
            </div>
            <a href="{{ route('catalogue.index') }}" class="btn btn-secondary btn-sm mt-4 md:mt-0 group">
                <span>View all</span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        {{-- Product Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
            @foreach($featuredProducts as $product)
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
                        {{-- Image Wrapper --}}
                        <a href="{{ route('products.show', $slug) }}" class="image-wrap relative aspect-square flex items-center justify-center bg-[var(--color-bg-elevated)] overflow-hidden block">
                            <img src="{{ $product->media->first()?->getUrl() ?: asset('images/product-vial-dummy.png') }}"
                                 alt="{{ $name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            {{-- Top Left Badge --}}
                            <span class="absolute left-3 top-3 px-2.5 py-1 rounded-full text-xs font-bold text-white shadow-md z-10"
                                  style="background: linear-gradient(135deg, var(--color-accent), var(--color-accent-dark));">
                                Best Seller
                            </span>
                        </a>

                        {{-- Card Body --}}
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
                                Synthetic Research Peptide (≥{{ $purity }} Purity)
                            </p>

                            {{-- Rating Stars --}}
                            <div class="flex items-center gap-1.5 mb-4">
                                <div class="flex items-center text-amber-400 text-xs">
                                    ★ ★ ★ ★ ★
                                </div>
                                <span class="text-xs text-[var(--color-text-muted)] font-medium">4.9 (54)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Footer --}}
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
    </div>
</section>

{{-- ══════════════════════════════════════
     4. RESEARCH CATEGORIES DOMAIN GRID
     ══════════════════════════════════════ --}}
<section class="section bg-[var(--color-bg-surface)] border-b border-[var(--color-border)]">
    <div class="container">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="section-label">Research Domains</span>
                <h2 class="text-3xl font-extrabold text-white mt-2">Explore by Reagent Category</h2>
            </div>
            <a href="{{ route('catalogue.index') }}" class="text-sm font-semibold text-[var(--color-accent-light)] hover:text-white transition flex items-center gap-1 mt-4 md:mt-0">
                View All Categories &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
            @foreach($categories as $cat)
                <a href="{{ route('catalogue.category', $cat->urls->first()?->slug ?? 'all') }}" class="card p-6 flex flex-col justify-between group hover:border-[var(--color-accent)] transition">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center text-[var(--color-accent-light)] mb-4 group-hover:scale-110 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-[var(--color-accent-light)] transition">
                            {{ $cat->attribute_data->get('name')?->getValue() ?? 'Category' }}
                        </h3>
                        <p class="text-xs text-[var(--color-text-secondary)] line-clamp-2">
                            {{ $cat->attribute_data->get('description')?->getValue() ?? 'High purity research reagents.' }}
                        </p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-semibold text-[var(--color-accent)]">
                        Browse Category &rarr;
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     5. TIERED BULK SAVINGS & QUALITY ASSURANCE
     ══════════════════════════════════════ --}}
<section class="section border-b border-[var(--color-border)]">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="section-label">Volume Reagent Discounts</span>
                <h2 class="text-3xl font-extrabold text-white mt-2 mb-6">Tiered Batch Savings for Laboratories</h2>
                <p class="text-[var(--color-text-secondary)] mb-6 leading-relaxed">
                    We offer automatic volume price breaks on all research peptide orders. Discounts apply seamlessly at checkout for any order of 3+ or 5+ vials per SKU.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-4 p-4 rounded-xl glass border border-[var(--color-border)]">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-bold">1-2</div>
                        <div>
                            <div class="text-sm font-bold text-white">Standard Unit Price</div>
                            <div class="text-xs text-[var(--color-text-secondary)]">Single vial pricing for small scale testing.</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-xl glass border border-violet-500/30">
                        <div class="w-10 h-10 rounded-lg bg-violet-500/20 border border-violet-500/40 flex items-center justify-center text-[var(--color-accent-light)] font-bold">3-4</div>
                        <div>
                            <div class="text-sm font-bold text-white">10% Batch Discount</div>
                            <div class="text-xs text-[var(--color-text-secondary)]">Automatic 10% price break per vial for 3+ units.</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-xl glass border border-cyan-500/30">
                        <div class="w-10 h-10 rounded-lg bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400 font-bold">5+</div>
                        <div>
                            <div class="text-sm font-bold text-white">20% Bulk Lab Discount</div>
                            <div class="text-xs text-[var(--color-text-secondary)]">Maximum 20% savings for institutional order volumes.</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('catalogue.index') }}" class="btn btn-primary">
                    Shop Volume Discounts
                </a>
            </div>

            <div class="glass p-8 rounded-2xl border border-[var(--color-border)] space-y-6">
                <h3 class="text-xl font-bold text-white">Analytical Quality Control</h3>

                <div class="space-y-4 text-sm text-[var(--color-text-secondary)]">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>High-Performance Liquid Chromatography (HPLC) purity verification above 99.0%.</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Mass Spectrometry (MS) analysis confirming exact molecular mass matching theoretical sequence.</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Sealed vacuum vials with inert nitrogen flush to ensure long shelf stability.</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>UK domestic dispatch in thermal protective packaging.</span>
                    </div>
                </div>

                <div class="pt-6 border-t border-[var(--color-border)]">
                    <a href="{{ route('page.show', 'quality-coa') }}" class="btn btn-secondary w-full">
                        Download Sample COAs (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     6. LATEST ARTICLES & GUIDES
     ══════════════════════════════════════ --}}
<section class="section border-b border-[var(--color-border)]">
    <div class="container">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="section-label">Scientific Resources</span>
                <h2 class="text-3xl font-bold text-white mt-2">Peptide Research & Storage Guides</h2>
            </div>
            <a href="{{ route('news.index') }}" class="text-sm font-semibold text-[var(--color-accent-light)] hover:text-white transition mt-4 md:mt-0">
                View All Articles &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestArticles as $article)
                <a href="{{ route('news.show', $article->slug) }}" class="card p-6 flex flex-col justify-between hover:border-[var(--color-accent)] transition">
                    <div>
                        <div class="text-xs text-[var(--color-text-muted)] font-mono mb-2">{{ $article->published_at?->format('M d, Y') }}</div>
                        <h3 class="text-lg font-bold text-white mb-3 hover:text-[var(--color-accent-light)] transition line-clamp-2">
                            {{ $article->title }}
                        </h3>
                        <p class="text-xs text-[var(--color-text-secondary)] line-clamp-3 mb-4">
                            {{ $article->short_description }}
                        </p>
                    </div>
                    <span class="text-xs font-semibold text-[var(--color-accent)] flex items-center gap-1">
                        Read Technical Paper &rarr;
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
