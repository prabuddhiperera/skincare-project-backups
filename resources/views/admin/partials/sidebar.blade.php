{{-- resources/views/admin/partials/sidebar.blade.php --}}
<aside class="w-64 bg-gray-900 text-white flex flex-col">
    <div class="p-6 text-2xl font-bold border-b border-gray-700">Admin Panel</div>
    <nav class="flex-1 p-4 space-y-4">
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active == 'dashboard' ? 'bg-gray-700' : '' }}">Dashboard</a>
        <a href="{{ route('admin.customers') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active == 'customers' ? 'bg-gray-700' : '' }}">Users</a>
        <a href="{{ route('admin.orders') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active == 'orders' ? 'bg-gray-700' : '' }}">Orders</a>
        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active == 'products' ? 'bg-gray-700' : '' }}">Products</a>
        <a href="{{ route('admin.reviews.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active == 'reviews' ? 'bg-gray-700' : '' }}">Reviews</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}" class="p-4 border-t border-gray-700">
        @csrf
        <button class="w-full py-2 bg-red-600 rounded hover:bg-red-700">Logout</button>
    </form>
</aside>
