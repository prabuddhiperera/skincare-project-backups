{{-- resources/views/admin/products/edit-product.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" 
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Price</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" 
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Category</label>
                <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update Product</button>
            </div>
        </form>
    </div>

</body>
</html>
