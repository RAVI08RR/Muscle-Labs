<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses ?? collect();

        return view('account.addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line_one' => 'required|string|max:255',
            'city'             => 'required|string|max:255',
            'postcode'         => 'required|string|max:20',
            'country_code'     => 'required|string|max:2',
        ]);

        return redirect()->route('account.addresses')->with('success', 'Address saved.');
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('account.addresses')->with('success', 'Address updated.');
    }

    public function destroy(int $id)
    {
        return redirect()->route('account.addresses')->with('success', 'Address removed.');
    }

    public function setDefault(int $id)
    {
        return redirect()->route('account.addresses')->with('success', 'Default address updated.');
    }
}
