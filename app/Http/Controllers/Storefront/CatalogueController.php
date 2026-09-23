<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lunar\Models\Collection;
use Lunar\Models\Product;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['variants.prices', 'urls', 'media', 'collections'])
            ->where('status', 'published');

        // Search query
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('attribute_data->name->en', 'like', "%{$search}%")
                  ->orWhere('attribute_data->description->en', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($categorySlug = $request->input('category')) {
            $query->whereHas('collections.urls', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Sorting
        $sort = $request->input('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('attribute_data->name->en', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'name_asc':
            default:
                $query->orderBy('attribute_data->name->en', 'asc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Collection::with(['urls'])
            ->whereHas('group', fn ($q) => $q->where('handle', 'categories'))
            ->get();

        return view('storefront.catalogue.index', compact('products', 'categories', 'sort', 'categorySlug', 'search'));
    }

    public function category(string $slug)
    {
        $category = Collection::whereHas('urls', fn ($q) => $q->where('slug', $slug))->firstOrFail();

        $products = Product::with(['variants.prices', 'urls', 'media'])
            ->where('status', 'published')
            ->whereHas('collections', fn ($q) => $q->where('lunar_collections.id', $category->id))
            ->paginate(12);

        $categories = Collection::with(['urls'])
            ->whereHas('group', fn ($q) => $q->where('handle', 'categories'))
            ->get();

        return view('storefront.catalogue.category', compact('category', 'products', 'categories'));
    }
}
