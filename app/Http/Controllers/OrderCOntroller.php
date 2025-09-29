<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display orders list.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        // Use scopeStatus + eager loading
        $orders = Order::with(['user', 'products'])
            ->status($status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders', 'status'));
    }

public function edit($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    $customers = USER::all();
    $products = Product::all();

    return view('admin.orders.edit', compact('order', 'customers', 'products'));
}

// Show single order details
    public function show($id)
    {
        $order = \App\Models\Order::with(['user', 'products'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }



// Update order
    public function update(Request $request, Order $order)
    {
        // Validate
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'status'      => 'required|in:pending,completed,delivered,cancelled',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        // Update order
        $order->update([
            'user_id' => $validated['customer_id'],
            'status'  => $validated['status'],
        ]);

        // Update products
        $syncData = [];
        foreach ($request->items as $item) {
            $syncData[$item['product_id']] = [
                'quantity' => $item['quantity']
            ];
        }
        $order->products()->sync($syncData);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

public function destroy($id)
{
    $order = Order::findOrFail($id);

    // Delete associated order items first
    $order->orderItems()->delete();

    // Delete the order
    $order->delete();

    return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
}



}
