<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Lunar\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['lines.purchasable.product'])
            ->where('user_id', Auth::id())
            ->latest('placed_at')
            ->paginate(10);

        return view('account.orders.index', compact('orders'));
    }

    public function show(string $ref)
    {
        $order = Order::with(['lines.purchasable.product', 'addresses'])
            ->where('reference', $ref)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('account.orders.show', compact('order'));
    }

    public function pdf(string $ref)
    {
        $order = Order::where('reference', $ref)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return redirect()->route('account.orders.show', $ref);
    }
}
