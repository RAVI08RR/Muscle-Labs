<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use App\Models\ProductCoa;

class PageController extends Controller
{
    public function show(string $slug)
    {
        // Special case pages
        if ($slug === 'faqs') {
            $faqs = Faq::where('is_published', true)->orderBy('sort_order')->get();
            return view('storefront.pages.faqs', compact('faqs'));
        }

        if ($slug === 'coa-search') {
            $coas = ProductCoa::with(['product.urls'])->latest()->paginate(15);
            return view('storefront.pages.coa-search', compact('coas'));
        }

        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('storefront.pages.show', compact('page'));
    }
}
