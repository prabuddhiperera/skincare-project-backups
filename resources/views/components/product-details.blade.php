{{-- resources/views/components/product-details.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Product Details</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#ffe8e9] min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('navigation-menu')

    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row gap-12">
            
            {{-- Product Image --}}
            <div class="lg:w-1/2">
                <img src="{{ asset($product->image) }}"
                     alt="{{ $product->name }}" 
                     class="w-full h-[500px] object-cover rounded-2xl shadow-lg">
            </div>

            {{-- Product Info --}}
            <div class="lg:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-pink-600 font-bold text-2xl mt-2">
                        ${{ number_format($product->price, 2) }}
                    </p>
                    <p class="text-gray-500 mt-4">{{ $product->description }}</p>

                    {{-- Average Rating --}}
                    @if($reviews->count() > 0)
                        <div class="mt-4 flex items-center gap-2">
                            <span class="text-yellow-500 text-lg">
                                ★ {{ number_format($reviews->avg('rating'), 1) }}
                            </span>
                            <span class="text-gray-500">
                                ({{ $reviews->count() }} reviews)
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Quantity Selector --}}
                <div class="mt-6 flex items-center gap-4">
                    <label for="quantityInput" class="font-semibold">Quantity:</label>
                    <input type="number" name="quantity" id="quantityInput" min="1" value="1"
                        class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                {{-- Action Buttons --}}
                <div class="mt-6 flex gap-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" id="quantityInputCart">
                        <button type="submit" 
                            class="inline-block text-sm text-[#db9289] border border-[#f3c4c1] bg-white hover:bg-[#db9289] hover:text-white font-semibold py-2 px-4 rounded transition duration-300">
                            Add to Cart
                        </button>
                    </form>

                    <form action="{{ route('checkout.now', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" id="quantityInputBuyNow">
                        <button type="submit" 
                            class="inline-block text-sm text-[#db9289] border border-[#f3c4c1] bg-white hover:bg-[#db9289] hover:text-white font-semibold py-2 px-4 rounded transition duration-300">
                            Buy Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="max-w-7xl mx-auto px-6 mt-12">
            <h2 class="text-2xl font-bold mb-6">Customer Reviews</h2>

            {{-- Review Form (only for logged in users) --}}
            @auth
                <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow mb-8">
                    @csrf
                    <label for="rating" class="block font-semibold mb-2">Your Rating</label>
                    <select name="rating" id="rating" class="border rounded p-2 w-32">
                        <option value="5">★★★★★</option>
                        <option value="4">★★★★☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="1">★☆☆☆☆</option>
                    </select>

                    <textarea name="comment" rows="3" placeholder="Write your review..."
                        class="w-full border rounded p-3 mt-3"></textarea>

                    <button type="submit" 
                        class="mt-3 px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded transition">
                        Submit Review
                    </button>
                </form>
            @else
                <p class="mb-6 text-gray-600">
                    <a href="{{ route('login') }}" class="text-pink-600">Login</a> to leave a review.
                </p>
            @endauth

            {{-- Show Reviews --}}
            @if($reviews->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($reviews as $review)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-800">{{ $review->user->name ?? 'Anonymous' }}</p>
                                <span class="text-yellow-500 text-sm">
                                    {{ str_repeat('★', $review->rating) }}
                                </span>
                            </div>
                            <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                            <p class="mt-2 text-sm text-gray-500">Posted on {{ $review->created_at->format('M d, Y') }}</p>

                            {{-- Edit/Delete only for owner --}}
                            @if(Auth::id() === $review->user_id)
                                <div class="mt-3 flex gap-3">
                                    <a href="{{ route('reviews.edit', $review->id) }}" 
                                       class="text-blue-600 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p>No reviews yet. Be the first to review!</p>
            @endif
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Script to sync quantity inputs --}}
    <script>
        const quantityInput = document.getElementById('quantityInput');
        const quantityInputCart = document.getElementById('quantityInputCart');
        const quantityInputBuyNow = document.getElementById('quantityInputBuyNow');

        if (quantityInput) {
            quantityInput.addEventListener('input', () => {
                quantityInputCart.value = quantityInput.value;
                quantityInputBuyNow.value = quantityInput.value;
            });

            // Initialize hidden inputs
            quantityInputCart.value = quantityInput.value;
            quantityInputBuyNow.value = quantityInput.value;
        }
    </script>
</body>
</html>
