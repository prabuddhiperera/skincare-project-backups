{{-- resources/views/components/favourites.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favourites | Élan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#ffe8e9] min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('navigation-menu')

    <main class="flex-1 py-12">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-2xl font-bold mb-6" style="font-family: 'Lora', serif;">My Favourites</h1>

            @if($favourites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($favourites as $fav)
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <img src="{{ $fav->product->image_url }}" 
                                 alt="{{ $fav->product->name }}" 
                                 class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $fav->product->name }}</h2>
                                <p class="text-gray-500 mt-1">LKR {{ number_format($fav->product->price, 2) }}</p>

                                <div class="mt-4 flex justify-between items-center">
                                    <form action="{{ route('user.favourites.remove', $fav->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 text-white bg-[#db9289] rounded-md hover:bg-[#ffbdbd] transition">
                                            Remove
                                        </button>
                                    </form>

                                    <a href="{{ route('user.product.show', $fav->product->id) }}" 
                                       class="text-[#db9289] hover:underline">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-700">You have no favourite products yet.</p>
            @endif
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
