<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User; // for stats only

class AdminController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Store a newly created admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6'
        ]);

        $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully!');
    }

    /**
     * Show a single admin.
     */
    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Update the specified admin.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:admins,email,' . $admin->id,
            'password' => 'sometimes|min:6'
        ]);

        $admin->update([
            'name'     => $request->name ?? $admin->name,
            'email'    => $request->email ?? $admin->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated!');
    }

    /**
     * Delete an admin.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted!');
    }

    // ================== AUTH METHODS ==================

    public function showLoginForm()
    {
        return view('auth.admin-login'); // blade file
    }
 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }


    // Dashboard
    public function dashboard()
    {
        $customersCount = User::count();
        $ordersCount    = Order::count();
        $productsCount  = Product::count();

        // Categories with product counts
        $categories = Category::withCount('products')->get();

        // Pick 6 random products as "Trending"
        $trendingProducts = Product::with('category')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'customersCount',
            'ordersCount',
            'productsCount',
            'categories',
            'trendingProducts'
        ));
    }


    public function customers()
    {
        // Fetch all customers
        $users = User::all();

        // Pass to Blade view
        return view('admin.customers.index', compact('users'));
    }

    public function createCustomer()
    {
        return view('admin.customers.create');
    }

    public function storeCustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->route('admin.customers')->with('success', 'Customer created successfully');
    }

    public function editCustomer($id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.edit', compact('user'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.customers')->with('success', 'Customer updated successfully');
    }

    public function deleteCustomer($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.customers')->with('success', 'Customer deleted successfully');
    }

    // ---------------- Customers API ----------------
    public function apiCustomers()
    {
        return response()->json(User::all());
    }

    public function getCustomer($id)
    {
        return response()->json(User::findOrFail($id));
    }
}
