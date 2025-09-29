<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css') {{-- Ensure Tailwind is loaded --}}
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-200 via-rose-200 to-red-200">

    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Admin Login</h1>

        {{-- Show Errors --}}
        @if($errors->any())
            <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Enter your email"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" placeholder="Enter your password"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600 transition">
                Login
            </button>
        </form>

        {{-- Footer --}}
        <p class="mt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Admin Panel. All rights reserved.
        </p>
    </div>

</body>
</html>
