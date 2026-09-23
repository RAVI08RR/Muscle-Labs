@extends('layouts.app')

@php
    $name = $product->attribute_data->get('name')?->getValue() ?? 'Peptide Reagent';
    $description = $product->attribute_data->get('description')?->getValue() ?? '';
    $purity = $product->attribute_data->get('purity')?->getValue() ?? '99.2%';
    $strength = $product->attribute_data->get('strength_size')?->getValue() ?? '5mg';
    $research = $product->attribute_data->get('research_info')?->getValue() ?? '';
    $storage = $product->attribute_data->get('storage_handling')?->getValue() ?? '';
    $categoryName = $product->collections->first()?->attribute_data->get('name')?->getValue() ?? 'peptides';

    $basePricePence = $variant?->prices->firstWhere('min_quantity', 1)?->price?->value ?? 1595;
    $tier2PricePence = round($basePricePence * 0.97); // 3% off
    $tier3PricePence = $variant?->prices->firstWhere('min_quantity', 3)?->price?->value ?? round($basePricePence * 0.95); // 5% off
    $tier5PricePence = $variant?->prices->firstWhere('min_quantity', 5)?->price?->value ?? round($basePricePence * 0.90); // 10% off

    $basePriceFormatted = number_format($basePricePence / 100, 2);
    $tier2Save = number_format(($basePricePence - $tier2PricePence) * 2 / 100, 2);
    $tier3Save = number_format(($basePricePence - $tier3PricePence) * 3 / 100, 2);
    $tier5Save = number_format(($basePricePence - $tier5PricePence) * 5 / 100, 2);
@endphp

@section('title', "Buy {$name} {$strength} | UK Research Peptide | Muscle Labs")
@section('meta_description', substr(strip_tags($description), 0, 160))

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8">
    
    {{-- ══════════════════════════════════════
         1. BREADCRUMB
         ══════════════════════════════════════ --}}
    <nav aria-label="breadcrumb" class="mb-6">
        <ol class="flex flex-wrap items-center gap-1.5 text-sm text-[var(--color-text-muted)]">
            <li><a class="transition-colors hover:text-white" href="{{ route('home') }}">Home</a></li>
            <li class="text-slate-600">&rsaquo;</li>
            <li><a class="transition-colors hover:text-white" href="{{ route('catalogue.index') }}">Shop</a></li>
            <li class="text-slate-600">&rsaquo;</li>
            <li><span class="font-medium text-white">{{ $name }}</span></li>
        </ol>
    </nav>

    {{-- ══════════════════════════════════════
         2. MAIN PRODUCT TWO-COLUMN GRID
         ══════════════════════════════════════ --}}
    <div class="grid gap-10 lg:grid-cols-2">
        
        {{-- LEFT COLUMN: IMAGE & THUMBNAILS --}}
        <div class="flex flex-col gap-3">
            <div class="relative aspect-square overflow-hidden rounded-xl border border-[var(--color-border)] bg-[var(--color-bg-elevated)] flex items-center justify-center">
                <img id="main-product-image"
                     alt="{{ $name }}"
                     class="w-full h-full object-contain p-4 transition duration-300"
                     src="{{ $product->media->first()?->getUrl() ?: asset('images/product-vial-dummy.png') }}" />
            </div>

            {{-- Thumbnails --}}
            <div class="flex gap-3">
                <button type="button"
                        onclick="switchGalleryImage('{{ asset('images/product-vial-dummy.png') }}', this)"
                        class="thumb-btn relative size-20 overflow-hidden rounded-lg border-2 border-[var(--color-accent)] bg-[var(--color-bg-elevated)] cursor-pointer">
                    <img alt="{{ $name }}" class="w-full h-full object-cover" src="{{ asset('images/product-vial-dummy.png') }}"/>
                </button>
                <button type="button"
                        onclick="switchGalleryImage('coa-document', this)"
                        class="thumb-btn relative size-20 overflow-hidden rounded-lg border-2 border-[var(--color-border)] bg-[var(--color-bg-card)] cursor-pointer flex flex-col items-center justify-center p-2 text-center hover:border-[var(--color-accent)] transition">
                    <svg class="w-6 h-6 text-cyan-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <span class="text-[10px] font-bold text-slate-300">View COA</span>
                </button>
            </div>
        </div>

        {{-- RIGHT COLUMN: PRODUCT DETAILS & ACTIONS --}}
        <div class="flex flex-col gap-5">
            {{-- Category & Stock Badges --}}
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2.5 py-0.5 text-xs font-semibold text-slate-300 capitalize">
                        {{ $categoryName }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-0.5 text-xs font-semibold text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        In Stock
                    </span>
                </div>

                <h1 class="font-heading text-3xl font-extrabold tracking-tight text-white md:text-5xl" style="font-family: var(--font-display);">
                    {{ $name }} <span class="text-[var(--color-text-muted)] font-normal ml-1">{{ $strength }}</span>
                </h1>

                <p class="leading-relaxed text-[var(--color-text-secondary)] font-medium text-sm">
                    Synthetic Pentadecapeptide
                </p>

                {{-- Rating Stars --}}
                <div class="inline-flex w-fit items-center gap-2 text-sm mt-1">
                    <div class="flex items-center text-cyan-400 text-sm">
                        ★ ★ ★ ★ ★
                    </div>
                    <span class="font-bold text-white">4.9</span>
                    <span class="text-[var(--color-text-muted)]">(54 reviews)</span>
                </div>
            </div>

            {{-- Price & Purity Tag --}}
            <div class="flex items-baseline gap-3 pt-1">
                <p class="font-heading text-4xl font-extrabold text-white tracking-tight" style="font-family: var(--font-display);">
                    £{{ $basePriceFormatted }}
                </p>
                <span class="rounded-full bg-cyan-500/10 border border-cyan-500/30 px-3 py-1 text-xs font-semibold text-cyan-400">
                    {{ $purity }} purity
                </span>
            </div>

            {{-- Bundle & Save Selector Grid --}}
            <fieldset class="flex flex-col gap-2">
                <legend class="mb-2 text-sm font-semibold text-white">
                    Bundle &amp; Save
                    <span class="ml-2 font-normal text-[var(--color-text-muted)]">Buy more of this peptide, save more</span>
                </legend>

                <div class="grid gap-2 grid-cols-4">
                    {{-- 1 unit --}}
                    <button type="button"
                            id="bundle-btn-1"
                            onclick="selectBundleTier(1, {{ $basePricePence }})"
                            class="bundle-btn relative flex flex-col items-center gap-0.5 rounded-lg border-2 px-2 py-2.5 text-center transition-colors border-[var(--color-accent)] bg-[var(--color-accent)]/10 cursor-pointer">
                        <span class="chk-badge absolute -top-2 -right-2 flex size-5 items-center justify-center rounded-full bg-[var(--color-accent)] text-white">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </span>
                        <span class="text-sm font-bold text-white">1 unit</span>
                        <span class="text-xs text-[var(--color-text-muted)]">Standard price</span>
                    </button>

                    {{-- 2+ units --}}
                    <button type="button"
                            id="bundle-btn-2"
                            onclick="selectBundleTier(2, {{ $tier2PricePence }})"
                            class="bundle-btn relative flex flex-col items-center gap-0.5 rounded-lg border-2 px-2 py-2.5 text-center transition-colors border-[var(--color-border)] bg-[var(--color-bg-card)] hover:border-[var(--color-accent)]/50 cursor-pointer">
                        <span class="text-sm font-bold text-white">2+ units</span>
                        <span class="text-xs font-semibold text-cyan-400">3% off</span>
                        <span class="text-[11px] text-[var(--color-text-muted)]">Save £{{ $tier2Save }}</span>
                    </button>

                    {{-- 3+ units --}}
                    <button type="button"
                            id="bundle-btn-3"
                            onclick="selectBundleTier(3, {{ $tier3PricePence }})"
                            class="bundle-btn relative flex flex-col items-center gap-0.5 rounded-lg border-2 px-2 py-2.5 text-center transition-colors border-[var(--color-border)] bg-[var(--color-bg-card)] hover:border-[var(--color-accent)]/50 cursor-pointer">
                        <span class="text-sm font-bold text-white">3+ units</span>
                        <span class="text-xs font-semibold text-cyan-400">5% off</span>
                        <span class="text-[11px] text-[var(--color-text-muted)]">Save £{{ $tier3Save }}</span>
                    </button>

                    {{-- 5+ units --}}
                    <button type="button"
                            id="bundle-btn-5"
                            onclick="selectBundleTier(5, {{ $tier5PricePence }})"
                            class="bundle-btn relative flex flex-col items-center gap-0.5 rounded-lg border-2 px-2 py-2.5 text-center transition-colors border-[var(--color-border)] bg-[var(--color-bg-card)] hover:border-[var(--color-accent)]/50 cursor-pointer">
                        <span class="text-sm font-bold text-white">5+ units</span>
                        <span class="text-xs font-semibold text-cyan-400">10% off</span>
                        <span class="text-[11px] text-[var(--color-text-muted)]">Save £{{ $tier5Save }}</span>
                    </button>
                </div>
            </fieldset>

            {{-- Stepper & Add To Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="flex flex-wrap items-center gap-3">
                @csrf
                <input type="hidden" name="variant_id" value="{{ $variant?->id }}">

                <div class="flex items-center rounded-lg border border-[var(--color-border)] bg-[var(--color-bg-input)] p-1">
                    <button type="button" onclick="decrementQty()" class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-white/10 text-white font-bold text-lg transition">-</button>
                    <input type="number" id="qty-input" name="quantity" value="1" min="1" max="100" readonly class="w-10 text-center text-white font-bold text-sm bg-transparent border-none outline-none">
                    <button type="button" onclick="incrementQty()" class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-white/10 text-white font-bold text-lg transition">+</button>
                </div>

                <button type="submit" class="btn btn-primary btn-lg flex-1 sm:flex-none font-bold text-sm py-3 px-8 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>
                    <span>Add to Cart</span>
                </button>
            </form>

            {{-- Certificate of Analysis Alert Box --}}
            <div class="relative grid w-full gap-1 rounded-lg border border-violet-500/30 bg-violet-500/5 p-3 text-sm">
                <div class="flex items-center gap-2 font-semibold text-white">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <span>Certificate of Analysis available</span>
                </div>
                <div class="text-xs text-[var(--color-text-secondary)]">
                    This batch has been independently tested at {{ $purity }} purity. View the COA in the image gallery.
                </div>
            </div>

            <hr class="divider">

            {{-- Interactive Tabs (Description / Specifications / Research Areas) --}}
            <div class="flex flex-col gap-2">
                <div class="inline-flex w-fit items-center justify-center rounded-lg p-1 bg-[var(--color-bg-elevated)] border border-[var(--color-border)]">
                    <button type="button" onclick="switchTab('description', this)" class="tab-trigger px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-[var(--color-accent)] transition">
                        Description
                    </button>
                    <button type="button" onclick="switchTab('specifications', this)" class="tab-trigger px-3 py-1.5 rounded-md text-xs font-semibold text-[var(--color-text-muted)] hover:text-white transition">
                        Specifications
                    </button>
                    <button type="button" onclick="switchTab('research', this)" class="tab-trigger px-3 py-1.5 rounded-md text-xs font-semibold text-[var(--color-text-muted)] hover:text-white transition">
                        Research Areas
                    </button>
                </div>

                <div id="tab-content-description" class="tab-content text-sm pt-2 text-[var(--color-text-secondary)] leading-relaxed">
                    <p>BPC-157 is a synthetic pentadecapeptide — a chain of 15 amino acids — derived from a naturally occurring protective protein found in human gastric juice. Supplied by Muscle Labs at {{ $strength }} per vial, this batch has been independently tested to {{ $purity }} purity, with the Certificate of Analysis available in the product gallery.</p>
                </div>

                <div id="tab-content-specifications" class="tab-content text-sm pt-2 text-[var(--color-text-secondary)] hidden">
                    <table class="table text-xs">
                        <tbody>
                            <tr><td class="font-bold text-white w-1/3">Sequence</td><td>H-Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val-OH</td></tr>
                            <tr><td class="font-bold text-white">Molecular Formula</td><td>C62H98N16O22</td></tr>
                            <tr><td class="font-bold text-white">Molecular Weight</td><td>1419.6 g/mol</td></tr>
                            <tr><td class="font-bold text-white">Purity Level</td><td>≥{{ $purity }} (HPLC Batch Verified)</td></tr>
                        </tbody>
                    </table>
                </div>

                <div id="tab-content-research" class="tab-content text-sm pt-2 text-[var(--color-text-secondary)] hidden">
                    <p>{{ $research ?: 'Evaluated in preclinical scientific literature for tendon-cell migration, collagen synthesis upregulation, angiogenesis signalling, and gastrointestinal mucosal model studies.' }}</p>
                </div>
            </div>

            <p class="rounded-lg bg-[var(--color-bg-surface)] p-4 text-xs leading-relaxed text-[var(--color-text-muted)] border border-[var(--color-border)]">
                For in-vitro research use only. This product is not intended for human consumption, medical, veterinary, or household use. By purchasing, you confirm you are a qualified researcher.
            </p>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         3. DETAILED RESEARCH KNOWLEDGE BASE CARD (Flex Peptides Full Content)
         ══════════════════════════════════════ --}}
    <section class="mt-16 rounded-2xl border border-[var(--color-border)] bg-[var(--color-bg-card)] p-6 md:p-10">
        <div class="mx-auto flex max-w-3xl flex-col gap-5">
            <p class="text-xs font-bold uppercase tracking-widest text-[var(--color-accent)]">RESEARCH PEPTIDE</p>
            
            <h2 class="font-heading text-2xl font-extrabold text-white md:text-3xl" style="font-family: var(--font-display);">
                {{ $name }} {{ $strength }}
            </h2>

            <p class="text-sm font-semibold text-[var(--color-text-secondary)]">
                Synthetic Pentadecapeptide for Laboratory Research | {{ $purity }} Purity | COA Verified
            </p>

            <div class="text-sm text-[var(--color-text-secondary)] space-y-4 leading-relaxed">
                <div>
                    <h3 class="text-base font-bold text-white mb-2">BPC-157 5mg: Background and Research Context</h3>
                    <p>
                        BPC-157 (Body Protection Compound-157) is a synthetic peptide fragment based on a sequence identified within human gastric juice in the early 1990s by researchers investigating naturally occurring gastroprotective proteins. Unlike many research peptides derived from hormone or growth-factor families, BPC-157's origin as a "stable gastric pentadecapeptide" is what first drew laboratory interest — the parent protein appeared to survive gastric conditions that degrade most peptides rapidly, which made its stability and mechanism a subject of ongoing preclinical study.
                    </p>
                    <p class="mt-3">
                        Since then, BPC-157 has become one of the most widely studied peptides in preclinical research literature, with published in-vitro and animal-model studies examining its effects on angiogenesis (blood vessel formation), tissue and tendon-cell behaviour, gut-barrier integrity, and interactions with nitric oxide signalling pathways.
                    </p>
                </div>

                {{-- Product Specifications Table --}}
                <div class="card p-5 bg-[var(--color-bg-surface)] rounded-xl border border-[var(--color-border)] my-4 text-xs font-mono space-y-1.5 text-slate-300">
                    <div><strong>Product Name:</strong> {{ $name }} {{ $strength }}</div>
                    <div><strong>Molecular Formula:</strong> C62H98N16O22</div>
                    <div><strong>Molecular Weight:</strong> 1419.6 g/mol</div>
                    <div><strong>Purity:</strong> ≥{{ $purity }} (batch-specific COA provided)</div>
                    <div><strong>Sequence:</strong> H-Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val-OH</div>
                    <div><strong>Form:</strong> Lyophilised solid, supplied in sealed vial</div>
                </div>

                <div>
                    <h3 class="text-base font-bold text-white mb-2">What the Research Literature Actually Covers</h3>
                    <p>Researchers commonly cite BPC-157 preclinical studies in the following areas:</p>
                    <ul class="list-disc pl-5 space-y-1 mt-2">
                        <li>Tendon and ligament cell research — in-vitro studies on fibroblast migration and tendon explant models</li>
                        <li>Gastrointestinal research — gut lining and mucosal integrity models</li>
                        <li>Angiogenesis research — animal-model studies on blood vessel formation pathways</li>
                        <li>Nitric oxide pathway research — vascular signalling interactions</li>
                        <li>Musculoskeletal research models — rodent studies on soft-tissue recovery markers</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-base font-bold text-white mb-2">Storage and Handling</h3>
                    <p>
                        Store the lyophilised vial as specified on the product label and accompanying documentation — protected from light, moisture, and temperature fluctuation. Once reconstituted for laboratory use, peptide stability is time- and temperature-dependent; researchers should follow institutional protocols.
                    </p>
                </div>

                <div>
                    <h3 class="text-base font-bold text-white mb-2">Quality Assurance</h3>
                    <p>
                        Every batch of BPC-157 sold by Muscle Labs is independently tested by third-party laboratory analysis (HPLC/MS), with the Certificate of Analysis for this specific batch available in the image gallery above.
                    </p>
                </div>

                <div>
                    <h3 class="text-base font-bold text-white mb-2">Why Muscle Labs</h3>
                    <p>
                        Muscle Labs is a UK-based supplier focused on high-purity peptide research materials with transparent sourcing and batch-level documentation.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function switchGalleryImage(src, btn) {
    document.querySelectorAll('.thumb-btn').forEach(b => {
        b.classList.remove('border-[var(--color-accent)]');
        b.classList.add('border-[var(--color-border)]');
    });
    btn.classList.remove('border-[var(--color-border)]');
    btn.classList.add('border-[var(--color-accent)]');

    const mainImg = document.getElementById('main-product-image');
    if (src === 'coa-document') {
        mainImg.src = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80';
    } else {
        mainImg.src = src;
    }
}

function selectBundleTier(qty, pricePence) {
    document.querySelectorAll('.bundle-btn').forEach(c => {
        c.classList.remove('border-[var(--color-accent)]', 'bg-[var(--color-accent)]/10');
        c.classList.add('border-[var(--color-border)]', 'bg-[var(--color-bg-card)]');
        const chk = c.querySelector('.chk-badge');
        if (chk) chk.remove();
    });

    const selectedBtn = document.getElementById('bundle-btn-' + qty);
    if (selectedBtn) {
        selectedBtn.classList.remove('border-[var(--color-border)]', 'bg-[var(--color-bg-card)]');
        selectedBtn.classList.add('border-[var(--color-accent)]', 'bg-[var(--color-accent)]/10');
        const checkMark = document.createElement('span');
        checkMark.className = 'chk-badge absolute -top-2 -right-2 flex size-5 items-center justify-center rounded-full bg-[var(--color-accent)] text-white';
        checkMark.innerHTML = '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
        selectedBtn.appendChild(checkMark);
    }

    const qtyInput = document.getElementById('qty-input');
    qtyInput.value = qty;
}

function incrementQty() {
    let input = document.getElementById('qty-input');
    input.value = parseInt(input.value) + 1;
}

function decrementQty() {
    let input = document.getElementById('qty-input');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function switchTab(tabName, btn) {
    document.querySelectorAll('.tab-trigger').forEach(b => {
        b.classList.remove('bg-[var(--color-accent)]', 'text-white');
        b.classList.add('text-[var(--color-text-muted)]');
    });
    btn.classList.add('bg-[var(--color-accent)]', 'text-white');
    btn.classList.remove('text-[var(--color-text-muted)]');

    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
    document.getElementById('tab-content-' + tabName).classList.remove('hidden');
}
</script>
@endsection
