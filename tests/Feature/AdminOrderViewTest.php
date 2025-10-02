<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminOrderViewTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);
    }

    protected function actingAsAdmin()
    {
        return $this->actingAs($this->admin, 'admin');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_view_all_orders(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->actingAsAdmin()->get('/orders');

        $response->assertStatus(200);

        foreach ($orders as $order) {
            $response->assertSee((string)$order->id);
        }
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_view_single_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->actingAsAdmin()->get("/orders/{$order->id}");

        $response->assertStatus(200);
        $response->assertSee((string)$order->id);
        $response->assertSee((string)$order->totalamount);
    }
}
