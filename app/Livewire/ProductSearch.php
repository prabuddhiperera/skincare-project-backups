<?php

// app/Http/Livewire/ProductSearch.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $query = '';
    public $products = [];

    public function updatedQuery()
    {
        $this->products = Product::where('name', 'like', '%' . $this->query . '%')->get();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}

