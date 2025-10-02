<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminCustomerReadTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin to authenticate
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
    public function admin_can_view_all_customers(): void
    {
        // Create some test customers
        $customers = User::factory()->count(3)->create();

        $response = $this->actingAsAdmin()->get(route('admin.customers'));

        // Should return HTTP 200
        $response->assertStatus(200);

        // Check that all created users' names appear in the response
        foreach ($customers as $customer) {
            $response->assertSee($customer->name);
            $response->assertSee($customer->email);
        }
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_view_single_customer(): void
    {
        $customer = User::factory()->create();

        $response = $this->actingAsAdmin()->get(route('admin.editCustomer', $customer->id));

        $response->assertStatus(200);
        $response->assertSee($customer->name);
        $response->assertSee($customer->email);
    }
}
