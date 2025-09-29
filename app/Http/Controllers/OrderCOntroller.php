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

        $orders = Order::with(['customer', 'orderItems.product'])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
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


public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'user_id' => $request->user_id,
        'orderdate'   => $request->orderdate,
        'status'      => $request->status,
    ]);

    // Replace items
    $order->orderItems()->delete();

    if ($request->has('items')) {
        foreach ($request->items as $item) {
            $order->orderItems()->create($item);
        }
    }

    return redirect()->route('admin.orders')->with('success', 'Order updated successfully.');
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
