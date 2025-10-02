<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order #{{ $order->id }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#ffe8e9] min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('navigation-menu')

    <main class="flex-1 py-12">
        <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Order #{{ $order->id }} Details</h1>

            {{-- Order Info --}}
            <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-100 p-4 rounded-lg">
                <div class="mb-2 md:mb-0">
                    <p><strong>Order Placed:</strong> {{ \Carbon\Carbon::parse($order->orderdate)->format('d M, Y') }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->totalamount, 2) }}</p>
                </div>
                <div>
                    <span class="px-4 py-2 rounded-full text-white font-semibold
                        @if($order->status == 'pending') bg-yellow-500
                        @elseif($order->status == 'completed') bg-green-500
                        @elseif($order->status == 'cancelled') bg-red-500
                        @else bg-gray-500
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            {{-- Order Items Table --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Product</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Quantity</th>
                            <th class="p-2 border">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="p-2 border">{{ $item->product->name }}</td>
                                <td class="p-2 border">${{ number_format($item->price, 2) }}</td>
                                <td class="p-2 border">{{ $item->quantity }}</td>
                                <td class="p-2 border">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="font-bold">
                            <td colspan="3" class="p-2 border text-right">Grand Total</td>
                            <td class="p-2 border">${{ number_format($order->totalamount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Back Button --}}
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-pink-500 text-white font-semibold rounded hover:bg-pink-600 transition">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
