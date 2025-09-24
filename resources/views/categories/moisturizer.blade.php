{{-- resources/views/categories/moisturizer.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moisturizer Products</title>
    @vite('resources/css/app.css') {{-- if using Vite/Tailwind --}}
</head>
<body class="bg-[#ffe8e9]">

    {{-- Custom Navbar --}}
    @include('layouts.navbar')

    <div class="min-h-screen flex flex-col">

        {{-- Banner --}}
        <div class="w-full">
            <img 
                src="{{ asset('img/moisturizer-banner.jpg') }}" 
                alt="Moisturizer Banner" 
                class="w-full h-[500px] object-cover">
        </div>

        {{-- Search / Filter --}}
        <section class="max-w-7xl mx-auto px-6 py-6">
            <form method="GET" action="{{ route('categories.moisturizer') }}" class="flex flex-wrap gap-4 justify-center">
                <input type="text" name="search" placeholder="Search moisturizers..." 
                       value="{{ request('search') }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300 w-full sm:w-[500px] lg:w-[600px]">
                <button type="submit" 
                        class="px-4 py-2 bg-[#db9289] text-white font-semibold rounded-lg hover:bg-[#c87b7c] transition">
                    Search
                </button>
            </form>
        </section>

        {{-- Product Grid --}}
        <section class="max-w-7xl mx-auto px-6 py-12 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 cursor-pointer"
                         style="min-width: 320px; max-width: 400px;"
                         onclick="openModal({{ $product->id }})">
                        <img src="{{ asset('uploads/products/'.$product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-56 object-cover rounded-xl">

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-pink-600 font-bold mt-1">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>
                        </div>
                    </div>

                    {{-- Hidden Modal --}}
                    <div id="modal-{{ $product->id }}" 
                         class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-6 relative">
                            <button onclick="closeModal({{ $product->id }})" 
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✕</button>
                            <img src="{{ asset('uploads/products/'.$product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover rounded-xl">
                            <h3 class="text-2xl font-bold mt-4">{{ $product->name }}</h3>
                            <p class="text-pink-600 font-bold text-lg mt-1">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-600 mt-3">{{ $product->description }}</p>

                            {{-- Reviews --}}
                            <div class="mt-5">
                                <h4 class="font-semibold text-gray-800 mb-2">Customer Reviews</h4>
                                @forelse($product->reviews as $review)
                                    <div class="border-b py-2">
                                        <p class="text-sm text-gray-700 font-semibold">{{ $review->user->name ?? 'Anonymous' }}</p>
                                        <p class="text-yellow-500 text-sm">Rating: {{ $review->rating }}/5</p>
                                        <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-sm">No reviews yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-600">No moisturizers found.</p>
                @endforelse
            </div>
        </section>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

    {{-- Modal JS --}}
    <script>
        function openModal(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModal(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</body>
</html>
