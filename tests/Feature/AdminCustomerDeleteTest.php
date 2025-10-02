<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminCustomerDeleteTest extends TestCase
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
    public function admin_can_delete_a_customer(): void
    {
        $customer = User::factory()->create();

        // Use route name instead of hardcoded URL
        $response = $this->actingAsAdmin()->delete(route('admin.deleteCustomer', $customer->id));

        // Expect a redirect (HTTP 302)
        $response->assertStatus(302);

        // Redirect should be to admin.customers page
        $response->assertRedirect(route('admin.customers'));

        // Assert the customer is deleted from the database
        $this->assertDatabaseMissing('users', [
            'id' => $customer->id,
        ]);
    }
}
