<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Customers</title>
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
                <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Categories</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-gray-700">
                @csrf
                <button class="w-full py-2 bg-red-600 rounded hover:bg-red-700">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-auto">

            <!-- Top Navbar -->
            <header class="bg-white shadow flex justify-between items-center px-6 py-4">
                <h1 class="text-xl font-bold text-gray-800">All Customers</h1>
                <a href="{{ route('admin.createCustomer') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Add Customer
                </a>
            </header>

            <!-- Customers Table -->
            <section class="p-6 flex-1">
                <div class="bg-white shadow rounded-lg p-6 overflow-auto">
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full table-auto border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Created At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $user->id }}</td>
                                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border">{{ $user->created_at }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('admin.editCustomer', $user->id) }}" class="text-green-600 hover:underline">Edit</a> |
                                        <form action="{{ route('admin.deleteCustomer', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No customers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

</body>
</html>
