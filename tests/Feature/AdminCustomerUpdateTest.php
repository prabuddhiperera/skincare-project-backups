<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminCustomerUpdateTest extends TestCase
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
    public function admin_can_update_a_customer(): void
    {
        $customer = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com'
        ]);

        $data = [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'password' => 'newpassword123',
        ];

        $response = $this->actingAsAdmin()->put(route('admin.updateCustomer', $customer->id), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.customers'));

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);
    }
}
