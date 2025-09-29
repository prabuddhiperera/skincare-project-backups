<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class Dashboard extends Component
{
    public $totalCustomers;
    public $totalOrders;
    public $categoryCounts;
    public $trendingProducts;

    public function mount()
    {
        $this->totalCustomers = User::where('is_admin', false)->count();
        $this->totalOrders = Order::count();

        $this->categoryCounts = Category::withCount('products')->get();

        $this->trendingProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
