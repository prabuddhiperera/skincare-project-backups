{{-- resources/views/admin/reviews/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar same as index -->
        @include('admin.partials.sidebar', ['active' => 'reviews'])

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto">
            <h1 class="text-3xl font-bold mb-6">Add Review</h1>

            <form action="{{ route('admin.reviews.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-semibold">User</label>
                    <select name="user_id" class="w-full border rounded px-3 py-2">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Product</label>
                    <select name="product_id" class="w-full border rounded px-3 py-2">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Comment</label>
                    <textarea name="comment" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Review
                </button>
            </form>
        </div>

    </div>

</body>
</html>
