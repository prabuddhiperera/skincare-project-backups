<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Review;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminReviewUpdateTest extends TestCase
{
    use RefreshDatabase;

     public function admin_can_update_a_review()
    {
        $review = Review::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $payload = [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'rating' => 5,
            'comment' => 'Updated comment',
        ];

        $response = $this->putJson("/admin/reviews/{$review->id}", $payload);

        $response->assertStatus(200); // adjust if controller redirects
        $this->assertDatabaseHas('reviews', $payload);
    }
}
