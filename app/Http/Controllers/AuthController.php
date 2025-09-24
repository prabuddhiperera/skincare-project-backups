<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register user
        public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name, // matches input field
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user); // optional: log user in immediately

        return redirect('/dashboard')->with('status', 'Registered successfully!');
    }

    // Login user
        public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate(); // Prevent session fixation
            return redirect()->intended('dashboard')->with('status', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    // Logout user
    public function logout(Request $request)
    {
        Auth::logout(); // logs out the user from session

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // redirect to home page
    }
}