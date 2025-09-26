<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(10)->get();
        $reviews = Review::with('user')->inRandomOrder()->take(6)->get();

        return view('dashboard', compact('products', 'reviews'));
    }
}
