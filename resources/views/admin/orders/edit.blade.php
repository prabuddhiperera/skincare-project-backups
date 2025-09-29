<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Order</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
  <div class="p-8 w-full max-w-5xl bg-white rounded-xl shadow-lg">
    <h1 class="text-2xl font-bold mb-8 text-gray-800 text-center">Edit Order #{{ $order->id }}</h1>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-8">
      @csrf
      @method('PUT')

      <!-- Customer -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
        <select name="customer_id" class="w-1/2 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
          @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ $order->user_id == $customer->id ? 'selected' : '' }}>
              {{ $customer->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Status -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select name="status" class="w-1/2 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
          <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
          <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
          <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
      </div>

      <!-- Products -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Products</h3>
        <div class="overflow-x-auto border rounded-lg mb-4">
          <table class="min-w-full text-sm text-left text-gray-700" id="products-table">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->products as $index => $product)
              <tr class="border-t">
                <td class="px-4 py-2">
                  <select name="items[{{ $index }}][product_id]" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @foreach($products as $p)
                      <option value="{{ $p->id }}" {{ $product->id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="px-4 py-2">
                  <input type="number" name="items[{{ $index }}][quantity]" value="{{ $product->pivot->quantity }}" min="1"
                    class="w-20 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                </td>
                <td class="px-4 py-2 text-center">
                  <button type="button" onclick="removeRow(this)" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Remove</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="text-right mb-4">
          <button type="button" onclick="addRow()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Add Product</button>
        </div>
      </div>

      <!-- Submit -->
      <div class="flex justify-center">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Update Order</button>
      </div>
    </form>
  </div>

  <script>
    let rowIndex = {{ $order->products->count() }};
    function addRow() {
      const tbody = document.querySelector('#products-table tbody');
      const tr = document.createElement('tr');
      tr.classList.add('border-t');
      tr.innerHTML = `
        <td class="px-4 py-2">
          <select name="items[\${rowIndex}][product_id]" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            @foreach($products as $p)
              <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
          </select>
        </td>
        <td class="px-4 py-2">
          <input type="number" name="items[\${rowIndex}][quantity]" value="1" min="1" class="w-20 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </td>
        <td class="px-4 py-2 text-center">
          <button type="button" onclick="removeRow(this)" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Remove</button>
        </td>
      `;
      tbody.appendChild(tr);
      rowIndex++;
    }

    function removeRow(button) {
      button.closest('tr').remove();
    }
  </script>
</body>
</html>
