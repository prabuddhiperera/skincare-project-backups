<!-- resources/views/livewire/product-search.blade.php -->
<div>
    <input type="text" wire:model="query" placeholder="Search products..." class="border rounded p-2 w-full">
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }} - ${{ $product->price }}</li>
        @endforeach
    </ul>
</div>
