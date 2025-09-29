<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brightening Products</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>
<body class="bg-[#ffe8e9]">

    {{-- Navigation --}}
    @include('navigation-menu')


    <div class="min-h-screen flex flex-col bg-[#ffe8e9]">

        {{-- Banner --}}
        <div class="w-full">
            <img 
                src="{{ asset('img/brightening-banner.jpg') }}" 
                alt="Brightening Banner" 
                class="w-full h-[498px] object-cover">
        </div>

        {{-- Search / Filter --}}
        <section class="max-w-7xl mx-auto px-6 py-6">
            <form method="GET" action="{{ route('user.shop.brightening') }}" class="flex flex-wrap gap-4 justify-center">

                {{-- Search Bar --}}
                <input type="text" name="search" placeholder="Search brightening products..." 
                    value="{{ request('search') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300 w-full sm:w-[500px] lg:w-[600px]">

                {{-- Filter Button --}}
                <button type="submit" 
                        class="px-4 py-2 bg-[#db9289] text-white font-semibold rounded-lg hover:bg-[#c87b7c] transition">
                    Search
                </button>
            </form>
        </section>

        {{-- Product Grid (Brightening only) --}}
        <section class="max-w-7xl mx-auto px-6 py-12 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <a href="{{ route('product.details', ['id' => $product->id]) }}" 
                       class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 cursor-pointer"
                         style="min-width: 320px; max-width: 400px;">
                        <img src="{{ asset('uploads/products/'.$product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-56 object-cover rounded-xl">
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-pink-600 font-bold mt-1">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-600 col-span-4 text-center">No brightening products found.</p>
                @endforelse
            </div>
        </section>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

</body>
</html>