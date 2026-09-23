@extends('layouts.app')

@section('title', 'Batch COA Certificate Verification — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl text-center">
        <span class="section-label">Quality Assurance</span>
        <h1 class="text-3xl font-extrabold text-white mt-1">Batch Certificate of Analysis (COA) Repository</h1>
        <p class="text-xs text-[var(--color-text-secondary)] mt-2">Every research batch is independently tested for purity and sequence verification.</p>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl">
        <div class="card p-6">
            <div class="divide-y divide-[var(--color-border)]">
                @foreach($coas as $coa)
                    @php
                        $productName = $coa->product?->attribute_data->get('name')?->getValue() ?? 'Peptide Reagent';
                    @endphp
                    <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-white mb-1">{{ $productName }}</h3>
                            <div class="text-xs text-[var(--color-text-muted)] font-mono">
                                Batch Ref: <span class="text-[var(--color-accent-light)] font-semibold">{{ $coa->batch_number }}</span> | Test Date: {{ $coa->test_date?->format('M d, Y') }}
                            </div>
                        </div>

                        <a href="{{ route('coa.pdf', $coa->id) }}" target="_blank" class="btn btn-secondary btn-sm">
                            Download PDF
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $coas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
