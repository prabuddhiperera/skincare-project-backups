<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a category
        $this->category = Category::create(['name' => 'acne']);

        // Create an admin
        $this->admin = Admin::factory()->create();

        // Create a product
        $this->product = Product::create([
            'name' => 'Face Cream',
            'brand' => 'SkinBrand',
            'description' => 'Moisturizing face cream',
            'price' => 25.50,
            'category_id' => $this->category->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_update_product()
    {
        $newData = [
            'name' => 'Updated Face Cream',
            'brand' => 'UpdatedBrand',
            'price' => 30.00,
            'category_id' => $this->category->id,
        ];

        // Send PUT request to update the product
        $response = $this->actingAs($this->admin, 'admin')
                         ->put(route('admin.products.update', $this->product->id), $newData);

        // Assert redirect to products index (assuming that's your controller behavior)
        $response->assertRedirect(route('admin.products.index'));

        // Assert database has the updated data
        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'name' => 'Updated Face Cream',
            'brand' => 'UpdatedBrand',
            'price' => 30.00,
            'category_id' => $this->category->id,
        ]);
    }
}
