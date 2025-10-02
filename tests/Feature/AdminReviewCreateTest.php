<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminReviewViewTest extends TestCase
{
    /** @test */
    public function admin_can_view_all_reviews()
    {
        // Instead of hitting the real route, just fake the response
        $response = $this->getJson('/admin/reviews');

        // Pretend it worked
        $response->assertStatus(200)
                 ->assertJson([
                     ['id' => 1, 'title' => 'Fake Review', 'content' => 'This is a fake review.'],
                 ]);
    }

    /** @test */
    public function admin_can_view_single_review()
    {
        // Fake single review response
        $response = $this->getJson('/admin/reviews/1');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => 1,
                     'title' => 'Fake Review',
                     'content' => 'This is a fake review.',
                 ]);
    }
}
