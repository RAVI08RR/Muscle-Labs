@extends('layouts.app')

@section('title', 'Frequently Asked Questions — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl text-center">
        <span class="section-label">Support Center</span>
        <h1 class="text-3xl font-extrabold text-white mt-1">Frequently Asked Questions</h1>
        <p class="text-xs text-[var(--color-text-secondary)] mt-2">Answers regarding reagent purity, shipping, batch COAs, and lab ordering.</p>
    </div>
</div>

<div class="section">
    <div class="container max-w-3xl space-y-4">
        @foreach($faqs as $faq)
            <div class="card p-6">
                <h3 class="text-base font-bold text-white mb-2 flex items-center gap-2">
                    <span class="text-[var(--color-accent)] font-mono">Q.</span>
                    {{ $faq->question }}
                </h3>
                <p class="text-xs text-[var(--color-text-secondary)] leading-relaxed pl-6">
                    {{ $faq->answer }}
                </p>
            </div>
        @endforeach
    </div>
</div>
@endsection
