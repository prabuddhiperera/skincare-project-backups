<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the single default admin

        Admin::firstOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        // create 10 users
        $users = User::factory(10)->create();

        // create categories 
        $categoryNames = [
            'Acne',
            'Hyperpigmentation',
            'Brightening',
            'Cleanser & Makeup Remover',
            'Moisturizer',
            'Makeup'
        ];

        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate(
                ['name' => $name],
                ['description' => "This category is for " . $name]
            );
        }

        // create products for each categories 
        $products = [];
        foreach ($categories as $name => $category) {
            $products = array_merge($products, Product::factory(5)->create([
                'category_id' => $category->id,
                'name' => $name . ' Product',
                'description' => 'Default description',
                'price' => 100,
                'image' => 'default.jpg',
            ])->all());
        }


        //create order, oderitems and payments 
        $orders = Order::factory(10)->create([
            'user_id' => $users->random()->id,
        ]);

        foreach ($orders as $order) {
            $items = OrderItem::factory(rand(1, 3))->create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);

            $totalAmount = $items->sum(function($item) {
                return $item->price * $item->quantity;
            });

            $order->update(['totalamount' => $totalAmount]);

            Payment::factory()->create([
                'order_id' => $order->id,
                'payment_amount' => $totalAmount,
            ]);
        }

        //create 1-5 reviews 
        foreach ($products as $product) {
            $reviewCount = rand(1, 5);
            for ($i = 0; $i < $reviewCount; $i++) {
                Review::factory()->create([
                    'user_id' => $users->random()->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
