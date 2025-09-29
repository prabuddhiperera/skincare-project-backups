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

        <p><strong>Customer:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->totalamount, 2) }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

        <a href="{{ route('admin.orders') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back</a>
    </div>
</body>
</html>
