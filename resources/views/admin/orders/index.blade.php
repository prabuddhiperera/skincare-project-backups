<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">Admin Panel</div>
        <nav class="flex-1 p-4 space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('admin.customers') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Users</a>
            <a href="{{ route('admin.orders') }}" class="block py-2 px-4 bg-gray-700 rounded">Orders</a>
            <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
            <a href="{{ route('admin.reviews.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Reviews</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-gray-700">
            @csrf
            <button class="w-full py-2 bg-red-600 rounded hover:bg-red-700">Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">

        <h1 class="text-3xl font-bold mb-6">Orders</h1>

        <!-- Status Filters -->
        <div class="flex gap-2 mb-4">
            <a href="{{ route('admin.orders') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">All</a>
            <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300">Pending</a>
            <a href="{{ route('admin.orders', ['status' => 'completed']) }}" class="px-4 py-2 bg-blue-200 rounded hover:bg-blue-300">Completed</a>
            <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="px-4 py-2 bg-red-200 rounded hover:bg-red-300">Cancelled</a>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse shadow-lg bg-white rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Customer</th>
                        <th class="border px-4 py-2 text-left">Total</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-left">Date</th>
                        <th class="border px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $order->id }}</td>
                            <td class="border px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $order->formatted_total }}</td>
                            <td class="border px-4 py-2">{{ $order->status_label }}</td>
                            <td class="border px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">View</a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
</body>
</html>
