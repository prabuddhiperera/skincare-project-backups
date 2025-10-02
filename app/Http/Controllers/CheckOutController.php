<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // This will be used for /checkout route
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate grand total
        $grandTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout', compact('cart', 'grandTotal'));
    }

    // This will be used for Buy Now button
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        $cart = [
            $id => [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $quantity,
                "image" => $product->image,
            ]
        ];

        // Save cart to session for checkout
        session(['cart' => $cart]);

        $grandTotal = $product->price * $quantity;

        return view('checkout', compact('cart', 'grandTotal'));
    }

    // Process the checkout form
    public function process(Request $request)
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty!');
    }

    $order = Order::create([
        'customer_id' => Auth::id(),
        'name' => $request->name,
        'address' => $request->address,
        'payment_method' => $request->payment_method,
        'status' => 'Pending',
        'totalamount' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        'orderdate' => now(),
    ]);

    foreach ($cart as $productId => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('track', ['order' => $order->id])
                     ->with('success', 'Order placed successfully!');
}


}
