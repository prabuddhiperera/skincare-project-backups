<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;


// Welcome Page
Route::get('/', function () {
    $products = Product::inRandomOrder()->take(10)->get();
    $reviews = Review::with('user')->inRandomOrder()->take(6)->get();
    return view('welcome', compact('products', 'reviews'));
});

// dashboard Page
Route::get('/dashboard', function () {
    $products = Product::inRandomOrder()->take(10)->get();
    $reviews = Review::with('user')->inRandomOrder()->take(6)->get();

    return view('dashboard', compact('products', 'reviews'));
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');




//shop page 
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

Route::get('/component-shop', function () {
    return view('components.shop', [
        'products' => \App\Models\Product::all(),
    ]);
})->name('component.shop');

//about page 
Route::get('/about', function () {
    return view('about');
})->name('about');


//before logged in 
Route::get('/categories/acne', [CategoryController::class, 'acne'])->name('categories.acne');
Route::get('/categories/hyperpigmentation', [CategoryController::class, 'hyperpigmentation'])->name('categories.hyperpigmentation');
Route::get('/categories/brightening', [CategoryController::class, 'brightening'])->name('categories.brightening');
Route::get('/categories/cleanser', [CategoryController::class, 'cleanser'])->name('categories.cleanser');
Route::get('/categories/moisturizer', [CategoryController::class, 'moisturizer'])->name('categories.moisturizer');
Route::get('/categories/makeup', [CategoryController::class, 'makeup'])->name('categories.makeup');


//admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');


Route::get('/logout', function () {
    Auth::logout();               // Logs out the user
    return redirect('/');         // Redirects to the home page
});
