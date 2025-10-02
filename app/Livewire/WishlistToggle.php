<?php

// app/Http/Livewire/WishlistToggle.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistToggle extends Component
{
    public $product;

    public function toggle()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
        } else {
            Wishlist::create(['user_id' => auth()->id(), 'product_id' => $this->product->id]);
        }

        $this->emit('wishlistUpdated');
    }

    public function render()
    {
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $this->product->id)->exists();

        return view('livewire.wishlist-toggle', ['exists' => $exists]);
    }
}

