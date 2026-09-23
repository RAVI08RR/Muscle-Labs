<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Lunar\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = Order::with(['lines.purchasable.product'])
            ->where('user_id', $user->id)
            ->latest('placed_at')
            ->take(5)
            ->get();

        return view('account.dashboard', compact('user', 'recentOrders'));
    }
}
