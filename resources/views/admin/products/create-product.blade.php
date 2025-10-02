{{-- resources/views/admin/products/create-product.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Product Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Brand</label>
                <input type="text" name="brand" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Price</label>
                <input type="number" name="price" step="0.01" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Category</label>
                <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Product</button>
            </div>
        </form>
    </div>

</body>
</html>
