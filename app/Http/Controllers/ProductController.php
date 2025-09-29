<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;                
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('category')->get(); // eager load category
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all(); // fetch all categories for dropdown
        return view('admin.products.create-product', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show a single product (API resource example).
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews; // assuming a relationship
        return view('components.product-details', compact('product', 'reviews'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit-product', compact('product', 'categories'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Delete a product.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully!');
    }


    public function popular()
    {
        $products = \App\Models\Product::inRandomOrder()->take(10)->get();

        return view('welcome', compact('products'));
    }

    
    public function shop()
    {
        $products = Product::with('reviews')->get();

        return view('shop', compact('products'));
    }

    public function userShop(Request $request)
    {
        // Start a query to fetch products with their reviews
        $query = Product::with('reviews');

        // Filter by search term if provided
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Get the final filtered products
        $products = $query->get();

        // Return the logged-in shop view with products
        return view('components.shop', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);

        // Optional: fetch reviews or ratings if needed
        $reviews = $product->reviews()->with('user')->get();

        return view('components.product-details', compact('product', 'reviews'));
    }

}
