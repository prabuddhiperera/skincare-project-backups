<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminOrderDeleteTest extends TestCase
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
    public function admin_can_delete_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->actingAsAdmin()->delete("/orders/{$order->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
        ]);
    }
}
