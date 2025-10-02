<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Existing web methods stay as-is: index, edit, show, update, destroy, track...

    // ----------------------
    // API methods for tests
    // ----------------------

    // GET /orders
    public function apiIndex()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    // GET /orders/{order}
    public function apiShow(Order $order)
    {
        return response()->json($order, 200);
    }

    // PUT /orders/{order}
    public function apiUpdate(Request $request, Order $order)
    {
        $order->update($request->only(['status']));
        return response()->json($order, 200);
    }

    // DELETE /orders/{order}
    public function apiDestroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 200);
    }
}
