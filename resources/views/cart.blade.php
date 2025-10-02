{{-- resources/views/components/cart.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Élan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#ffe8e9] min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('navigation-menu')

    <main class="flex-1 py-12">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="overflow-x-auto bg-white shadow rounded-lg">
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="p-3">Product</th>
                                <th class="p-3">Quantity</th>
                                <th class="p-3">Price</th>
                                <th class="p-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php 
                                    $total = $item['price'] * $item['quantity']; 
                                    $grandTotal += $total; 
                                @endphp
                                <tr class="border-t">
                                    <td class="p-3">{{ $item['name'] }}</td>
                                    <td class="p-3">{{ $item['quantity'] }}</td>
                                    <td class="p-3">${{ number_format($item['price'], 2) }}</td>
                                    <td class="p-3">${{ number_format($total, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="font-bold bg-gray-100">
                                <td colspan="3" class="p-3 text-right">Grand Total</td>
                                <td class="p-3">${{ number_format($grandTotal, 1) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('checkout.index') }}" 
                       class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg shadow transition">
                        Proceed to Checkout
                    </a>
                </div>
            @else
                <p class="text-gray-700">Your cart is empty.</p>
            @endif
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
