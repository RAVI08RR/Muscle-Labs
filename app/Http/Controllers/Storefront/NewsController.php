<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Article;

class NewsController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('storefront.news.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        $recentArticles = Article::where('published', true)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('storefront.news.show', compact('article', 'recentArticles'));
    }
}
