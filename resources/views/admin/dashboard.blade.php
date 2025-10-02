<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <a href="{{ route('admin.orders') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Orders</a>
                <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
                <a href="{{ route('admin.reviews.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Reviews</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-gray-700">
                @csrf
                <button class="w-full py-2 bg-red-600 rounded hover:bg-red-700">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">

            <!-- Top Navbar -->
            <header class="bg-white shadow flex justify-between items-center px-6 py-4">
                <h1 class="text-xl font-bold text-gray-800">Admin Dashboard</h1>
                <div class="flex items-center gap-4">
                    <button class="text-gray-600 hover:text-gray-800">⚙️ Settings</button>
                    <button class="text-gray-600 hover:text-gray-800">👤 Profile</button>
                </div>
            </header>

            <!-- Stats -->
            <section class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="text-lg font-semibold text-gray-600">Customers</h2>
                    <p class="text-3xl font-bold text-indigo-600">{{ $customersCount }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="text-lg font-semibold text-gray-600">Orders</h2>
                    <p class="text-3xl font-bold text-green-600">{{ $ordersCount }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="text-lg font-semibold text-gray-600">Products</h2>
                    <p class="text-3xl font-bold text-pink-600">{{ $productsCount }}</p>
                </div>
            </section>

            <!-- Categories -->
            <section class="p-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Categories & Product Counts</h2>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border">Category</th>
                                <th class="py-2 px-4 border">Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="py-2 px-4 border">{{ $category->name }}</td>
                                    <td class="py-2 px-4 border text-center">{{ $category->products_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
