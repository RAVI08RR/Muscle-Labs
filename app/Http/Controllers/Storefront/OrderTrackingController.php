<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\OrderShipment;
use Illuminate\Http\Request;
use Lunar\Models\Order;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('storefront.tracking.index');
    }

    public function lookup(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'email'     => 'required|email',
        ]);

        $order = Order::with(['lines.purchasable.product', 'addresses'])
            ->where('reference', trim($request->reference))
            ->whereHas('addresses', fn ($q) => $q->where('contact_email', trim($request->email)))
            ->first();

        if (! $order) {
            return back()->withInput()->with('error', 'No order found matching that reference number and email address.');
        }

        $shipments = OrderShipment::where('order_id', $order->id)->get();

        return view('storefront.tracking.result', compact('order', 'shipments'));
    }
}
