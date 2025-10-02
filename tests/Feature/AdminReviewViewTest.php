<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use App\Models\Review;

class AdminReviewViewTest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function admin_can_view_single_review()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $review = Review::factory()->create();

        $response = $this->getJson("/admin/reviews/{$review->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $review->id,
                 ]);
    }
}
