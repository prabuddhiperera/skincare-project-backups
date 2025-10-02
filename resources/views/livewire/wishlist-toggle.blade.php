<!-- resources/views/livewire/wishlist-toggle.blade.php -->
<button wire:click="toggle" class="px-3 py-1 border rounded">
    {{ $exists ? 'Remove from Wishlist' : 'Add to Wishlist' }}
</button>
