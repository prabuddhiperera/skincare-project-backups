<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->count() === 0 || $products->count() === 0) {
            $this->command->info('No users or products found. Please seed them first!');
            return;
        }

        foreach ($products as $product) {
            $reviewCount = rand(1, 5);
            for ($i = 0; $i < $reviewCount; $i++) {
                Review::factory()->create([
                    'user_id' => $users->random()->id, // match your Review model
                    'product_id' => $product->id,
                ]);
            }
        }

        $this->command->info('Reviews seeded successfully!');
    }
}
