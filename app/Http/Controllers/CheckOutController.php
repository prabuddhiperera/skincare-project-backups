<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity', 1);

        // Store directly in session as a temporary checkout
        session()->put('checkout_now', [
            'product' => $product,
            'quantity' => $quantity,
        ]);

        return redirect()->route('checkout.show');
    }

    public function show()
    {
        $checkout = session('checkout_now');
        return view('checkout.show', compact('checkout'));
    }
}
