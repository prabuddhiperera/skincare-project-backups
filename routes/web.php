<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;



// ----------------------
// Public Pages
// ----------------------
Route::get('/', function () {
    $products = Product::inRandomOrder()->take(10)->get();
    $reviews = Review::with('user')->inRandomOrder()->take(6)->get();
    return view('welcome', compact('products', 'reviews'));
});

Route::get('/about', fn() => view('about'))->name('about');

Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

Route::get('/component-shop', function () {
    $products = Product::query()
        ->when(request('search'), fn($q) => $q->where('name', 'like', '%' . request('search') . '%'))
        ->when(request('category'), fn($q) => $q->where('category', request('category')))
        ->get();

    return view('components.shop', compact('products'));
})->name('component.shop');

// ----------------------
// Categories (Before Login)
// ----------------------
Route::prefix('categories')->group(function () {
    Route::get('/acne', [CategoryController::class, 'acne'])->name('categories.acne');
    Route::get('/hyperpigmentation', [CategoryController::class, 'hyperpigmentation'])->name('categories.hyperpigmentation');
    Route::get('/brightening', [CategoryController::class, 'brightening'])->name('categories.brightening');
    Route::get('/cleanser', [CategoryController::class, 'cleanser'])->name('categories.cleanser');
    Route::get('/moisturizer', [CategoryController::class, 'moisturizer'])->name('categories.moisturizer');
    Route::get('/makeup', [CategoryController::class, 'makeup'])->name('categories.makeup');
});

// ----------------------
// Authentication (Users)
// ----------------------
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ----------------------
// User Dashboard
// ----------------------
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ----------------------
// Admin Routes
// ----------------------
Route::prefix('admin')->group(function () {

    // Admin login
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    });

    // Admin authenticated area
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Customer CRUD
        Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
        Route::get('/customers/create', [AdminController::class, 'createCustomer'])->name('admin.createCustomer');
        Route::post('/customers', [AdminController::class, 'storeCustomer'])->name('admin.storeCustomer');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('admin.editCustomer');
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('admin.updateCustomer');
        Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.deleteCustomer');

        // Admin Orders CRUD
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('admin.orders.store');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::put('/orders/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Admin Product CRUD
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'show'])->name('admin.products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});

// ----------------------
// Shop (Authenticated Users)
// ----------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/user/shop', [ProductController::class, 'userShop'])->name('user.shop');
    Route::get('/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');

    Route::get('/categories/acne', function () {
        $category = Category::where('name', 'Acne')->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('components.categories.acne', compact('products'));
    })->name('user.shop.acne');


    Route::get('/categories/hyperpigmentation', function () {
        $category = Category::where('name', 'Hyperpigmentation')->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('components.categories.hyperpigmentation', compact('products'));
    })->name('user.shop.hyperpigmentation');

    Route::get('/categories/brightening', function () {
        $category = Category::where('name', 'brightening')->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('components.categories.brightening', compact('products'));
    })->name('user.shop.brightening');

    Route::get('/categories/moisturizer', function () {
        $category = Category::where('name', 'moisturizer')->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('components.categories.moisturizer', compact('products'));
    })->name('user.shop.moisturizer');

    Route::get('/categories/makeup', function () {
        $category = Category::where('name', 'makeup')->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('components.categories.makeup', compact('products'));
    })->name('user.shop.makeup');

    Route::get('/user/shop/categories/cleanser', function () {
        // Fetch the category first
        $category = \App\Models\Category::where('name', 'Cleanser & Makeup Remover')->firstOrFail();

        // Get all products in this category
        $products = \App\Models\Product::where('category_id', $category->id)->get();

        // Pass $products to the Blade view
        return view('components.categories.cleanser', compact('products', 'category'));
    })->name('user.shop.cleanser');

    
});

// ----------------------
// Cart + Checkout
// ----------------------
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/checkout/now/{id}', [CheckoutController::class, 'buyNow'])->name('checkout.now');
});
