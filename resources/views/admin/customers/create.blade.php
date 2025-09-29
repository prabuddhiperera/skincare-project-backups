<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="flex-1 p-4 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.customers') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Users</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-gray-700">
                @csrf
                <button class="w-full py-2 bg-red-600 rounded hover:bg-red-700 font-semibold">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center p-6">

            <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-lg">
                <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Add New Customer</h1>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.storeCustomer') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">Create Customer</button>
                </form>
            </div>

        </main>
    </div>

</body>
</html>
