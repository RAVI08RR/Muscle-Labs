<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lunar\Facades\CartSession;
use Lunar\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = CartSession::current();

        if (! $cart || $cart->lines->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('storefront.checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:50',
            'address'    => 'required|string|max:255',
            'city'       => 'required|string|max:255',
            'postcode'   => 'required|string|max:20',
            'country'    => 'required|string|max:2',
        ]);

        $cart = CartSession::current();

        if (! $cart || $cart->lines->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Create Order reference
        $ref = 'ML-' . strtoupper(bin2hex(random_bytes(4)));

        // Create Order record via Lunar order creation
        $order = $cart->createOrder();
        $order->reference = $ref;
        $order->status = 'payment-received';
        $order->placed_at = now();
        $order->save();

        // Clear cart session
        CartSession::forget();

        return redirect()->route('checkout.thankyou', ['ref' => $ref]);
    }

    public function thankyou(string $ref)
    {
        $order = Order::with(['lines.purchasable.product', 'addresses'])
            ->where('reference', $ref)
            ->firstOrFail();

        return view('storefront.checkout.thankyou', compact('order'));
    }

    public function stripeWebhook(Request $request)
    {
        // Stripe webhook handler
        return response()->json(['status' => 'success']);
    }
}
