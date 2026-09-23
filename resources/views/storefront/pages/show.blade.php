@extends('layouts.app')

@section('title', ($page->seo_title ?: $page->title) . ' — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-4xl">
        <h1 class="text-3xl font-extrabold text-white">{{ $page->title }}</h1>
    </div>
</div>

<div class="section">
    <div class="container max-w-4xl">
        <div class="card p-8 text-[var(--color-text-secondary)] leading-relaxed space-y-4">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
