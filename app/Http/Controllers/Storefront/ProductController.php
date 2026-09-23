<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\ProductCoa;
use Lunar\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with(['variants.prices', 'urls', 'media', 'collections'])
            ->whereHas('urls', fn ($q) => $q->where('slug', $slug))
            ->where('status', 'published')
            ->firstOrFail();

        $variant = $product->variants->first();

        // Get COA if available
        $coa = ProductCoa::where('product_id', $product->id)->first();

        // Related products in same category
        $relatedProducts = Product::with(['variants.prices', 'urls'])
            ->where('status', 'published')
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('storefront.products.show', compact('product', 'variant', 'coa', 'relatedProducts'));
    }
}
