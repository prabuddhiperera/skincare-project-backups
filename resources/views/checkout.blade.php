<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#ffe8e9] min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('navigation-menu')

    <main class="flex-1 py-12">
        <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Checkout</h1>

            <table class="w-full border mb-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Product</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td class="p-2">{{ $item['name'] }}</td>
                            <td class="p-2">{{ $item['quantity'] }}</td>
                            <td class="p-2">${{ number_format($item['price'], 2) }}</td>
                            <td class="p-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="font-bold">
                        <td colspan="3" class="p-2 text-right">Grand Total</td>
                        <td class="p-2">${{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Checkout Form --}}
            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-semibold">Full Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Address</label>
                    <input type="text" name="address" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Payment Method</label>
                    <select name="payment_method" class="w-full border rounded p-2" required>
                        <option value="cod">Cash on Delivery</option>
                        <option value="card">Credit/Debit Card</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded">
                    Place Order
                </button>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
