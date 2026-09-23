<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
use Lunar\Models\Collection;
use Lunar\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['variants.prices', 'urls', 'media'])
            ->where('status', 'published')
            ->take(8)
            ->get();

        $categories = Collection::with(['urls'])
            ->whereHas('group', fn ($q) => $q->where('handle', 'categories'))
            ->get();

        $latestArticles = Article::where('published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $faqs = Faq::where('is_published', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('storefront.home', compact('featuredProducts', 'categories', 'latestArticles', 'faqs'));
    }
}
