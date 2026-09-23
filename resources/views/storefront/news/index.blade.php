@extends('layouts.app')

@section('title', 'Scientific Research & News — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">Peptide Research Articles & Guides</h1>
        <p class="text-xs text-[var(--color-text-secondary)] mt-2">Technical papers, laboratory protocols, storage instructions, and peer-reviewed literature reviews.</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($articles as $article)
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

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
