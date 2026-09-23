<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lunar\Facades\CartSession;
use Lunar\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = CartSession::current();

        return view('storefront.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::findOrFail($request->variant_id);
        $quantity = (int) $request->quantity;

        CartSession::add($variant, $quantity);

        if ($request->wantsJson()) {
            $cart = CartSession::current();
            return response()->json([
                'success'    => true,
                'message'    => 'Item added to cart',
                'cart_count' => $cart ? $cart->lines->sum('quantity') : 0,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'line_id'  => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        CartSession::updateLine($request->line_id, (int) $request->quantity);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'line_id' => 'required',
        ]);

        CartSession::remove($request->line_id);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
