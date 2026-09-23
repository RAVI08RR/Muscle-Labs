@extends('layouts.app')

@section('title', $article->seo_title ?: $article->title)
@section('meta_description', $article->seo_description ?: $article->short_description)

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-3xl">
        <div class="text-xs text-[var(--color-accent-light)] font-mono mb-2">Published {{ $article->published_at?->format('F d, Y') }}</div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-4">{{ $article->title }}</h1>
        <p class="text-base text-[var(--color-text-secondary)] leading-relaxed">{{ $article->short_description }}</p>
    </div>
</div>

<div class="section">
    <div class="container max-w-3xl">
        <article class="prose prose-invert max-w-none space-y-6 text-[var(--color-text-secondary)] leading-relaxed">
            {!! $article->body !!}
        </article>

        <!-- Research Disclaimer Banner -->
        <div class="research-notice mt-12">
            <svg class="icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <div>
                <strong>Scientific Literature Review Notice:</strong> Articles and literature reviews published on this website are provided strictly for educational and scientific research background.
            </div>
        </div>
    </div>
</div>
@endsection
