<?php

// app/Http/Livewire/ReviewForm.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Review;

class ReviewForm extends Component
{
    public $product_id, $content, $rating;

    public function submit()
    {
        $this->validate([
            'content' => 'required|min:5',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'product_id' => $this->product_id,
            'content' => $this->content,
            'rating' => $this->rating,
            'user_id' => auth()->id()
        ]);

        $this->reset(['content','rating']);
        $this->emit('reviewAdded');
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}

