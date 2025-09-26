<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


// Welcome Page
Route::get('/', function () {
    $products = Product::inRandomOrder()->take(10)->get();
    $reviews = Review::with('user')->inRandomOrder()->take(6)->get();
    return view('welcome', compact('products', 'reviews'));
});

// About Page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Shop Page
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// Component Shop (optional)
Route::get('/component-shop', function () {
    $products = \App\Models\Product::query()
        ->when(request('search'), fn($q) => $q->where('name', 'like', '%' . request('search') . '%'))
        ->when(request('category'), fn($q) => $q->where('category', request('category')))
        ->get();

    return view('components.shop', compact('products'));
})->name('component.shop');


// Category Pages (Before Login)
Route::prefix('categories')->group(function () {
    Route::get('/acne', [CategoryController::class, 'acne'])->name('categories.acne');
    Route::get('/hyperpigmentation', [CategoryController::class, 'hyperpigmentation'])->name('categories.hyperpigmentation');
    Route::get('/brightening', [CategoryController::class, 'brightening'])->name('categories.brightening');
    Route::get('/cleanser', [CategoryController::class, 'cleanser'])->name('categories.cleanser');
    Route::get('/moisturizer', [CategoryController::class, 'moisturizer'])->name('categories.moisturizer');
    Route::get('/makeup', [CategoryController::class, 'makeup'])->name('categories.makeup');
});


// User Registration & Login
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//Dashboard (authenticated users)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


//Admin ROutes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
});


//Logout Route
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    // Logged-in shop
    Route::get('/user/shop', [ProductController::class, 'userShop'])->name('user.shop');

    // Product details page
    Route::get('/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');

    // Acne category page (blade only)
    Route::get('/user/shop/categories/acne', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'acne')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.acne', compact('products', 'category'));
    })->name('user.shop.acne');

    // Hyperpigmentation category page
    Route::get('/user/shop/categories/hyperpigmentation', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'hyperpigmentation')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.hyperpigmentation', compact('products', 'category'));
    })->name('user.shop.hyperpigmentation');


    // Brightening category page
    Route::get('/user/shop/categories/brightening', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'brightening')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.brightening', compact('products', 'category'));
    })->name('user.shop.brightening');

    // cleanser category page
    Route::get('/user/shop/categories/cleanser', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'cleanser')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.cleanser', compact('products', 'category'));
    })->name('user.shop.cleanser');

    // Cleanser & Makeup Remover category page
    Route::get('/user/shop/categories/cleanser', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'Cleanser & Makeup Remover')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.cleanser', compact('products', 'category'));
    })->name('user.shop.cleanser');


    // moisturizer category page
    Route::get('/user/shop/categories/moisturizer', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'moisturizer')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.moisturizer', compact('products', 'category'));
    })->name('user.shop.moisturizer');
    

    // moisturizer category page
    Route::get('/user/shop/categories/makeup', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'makeup')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.makeup', compact('products', 'category'));
    })->name('user.shop.makeup');

});


Route::middleware(['auth'])->group(function () {
    // Add to Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

    // Checkout Now (Buy Now)
    Route::post('/checkout/now/{id}', [CheckoutController::class, 'buyNow'])->name('checkout.now');
});