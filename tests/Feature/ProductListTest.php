<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductListTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a category
        $this->category = Category::create(['name' => 'acne']);

        // Create an admin
        $this->admin = Admin::factory()->create();

        // Create multiple products
        $this->products = collect([
            ['name' => 'Face Cream', 'brand' => 'SkinBrand', 'price' => 25.50],
            ['name' => 'Brightening Serum', 'brand' => 'GlowCo', 'price' => 35.00],
            ['name' => 'Cleanser', 'brand' => 'PureSkin', 'price' => 15.00],
        ])->map(fn($data) => Product::create(array_merge($data, [
            'description' => $data['name'] . ' description',
            'category_id' => $this->category->id,
        ])));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_view_product_list_and_details()
    {
        // Visit the products index page as admin
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.products.index'));

        // Assert page loads successfully
        $response->assertStatus(200);

        // Assert each product appears in the table with all details
        foreach ($this->products as $product) {
            $response->assertSee($product->name); // Name
            $response->assertSee($product->brand); // Brand
            $response->assertSee('$' . number_format($product->price, 2)); // Price with $ sign
            $response->assertSee($this->category->name); // Category
        }
    }
}
