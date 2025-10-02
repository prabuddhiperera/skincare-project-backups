<!-- resources/views/livewire/review-form.blade.php -->
<form wire:submit.prevent="submit">
    <textarea wire:model="content" placeholder="Write your review..." class="w-full p-2 border rounded"></textarea>
    <input type="number" wire:model="rating" min="1" max="5" class="border p-2 rounded">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
</form>
