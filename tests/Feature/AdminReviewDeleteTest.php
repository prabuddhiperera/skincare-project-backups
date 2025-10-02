<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Review;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminReviewDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_review()
    {
        // create and authenticate admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // create a user & product for the review
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // create review
        $review = Review::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        // delete request
        $response = $this->delete("/admin/reviews/{$review->id}");

        // assert redirect (controller usually redirects after delete)
        $response->assertStatus(302);

        // assert review no longer exists in database
        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id,
        ]);
    }
}
