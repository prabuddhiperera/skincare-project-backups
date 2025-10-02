<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create categories for testing
        $this->categories = collect([
            'acne',
            'hyperpigmentation',
            'brightening',
            'cleanser & makeup remover',
            'makeup moisturizer'
        ])->map(fn($name) => Category::create(['name' => $name]));

        // Create an admin
        $this->admin = Admin::factory()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_create_product()
    {
        $category = $this->categories->first();

        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.products.store'), [
            'name' => 'Face Cream',
            'brand' => 'SkinBrand',
            'description' => 'Moisturizing face cream',
            'price' => 25.50,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(302); // Redirect after successful creation
        $this->assertDatabaseHas('products', [
            'name' => 'Face Cream',
            'category_id' => $category->id,
        ]);
    }
}
