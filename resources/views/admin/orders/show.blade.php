<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

        <p><strong>Customer:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <p><strong>Status:</strong> {{ $order->status_label }}</p>
        <p><strong>Total:</strong> {{ $order->formatted_total }}</p>
        <p><strong>Order Date:</strong> {{ $order->orderdate ? $order->orderdate->format('d M Y') : 'N/A' }}</p>

        <h3 class="mt-4 font-semibold">Products:</h3>
        @if($order->products->count())
            <ul class="list-disc pl-6">
                @foreach($order->products as $product)
                    <li>{{ $product->name }} × {{ $product->pivot->quantity ?? 1 }} — Rs. {{ number_format($product->pivot->price, 2) }}</li>
                @endforeach
            </ul>
        @else
            <p>No products found.</p>
        @endif

        <a href="{{ route('admin.orders') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back</a>
    </div>
</body>
</html>
