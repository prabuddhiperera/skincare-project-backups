<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create categories
        $this->category = Category::create(['name' => 'acne']);

        // Create an admin
        $this->admin = Admin::factory()->create();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_delete_product()
    {
        // Create a product
        $product = Product::create([
            'name' => 'Face Cream',
            'brand' => 'SkinBrand',
            'description' => 'Moisturizing face cream',
            'price' => 25.50,
            'category_id' => $this->category->id,
        ]);

        // Send DELETE request as admin
        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.products.destroy', $product->id));

        // Assert redirect (usually back to index)
        $response->assertStatus(302);

        // Assert product is deleted
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'name' => 'Face Cream',
        ]);
    }
}
