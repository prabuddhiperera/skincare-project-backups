<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminCustomerCreateTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin for authentication
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
    public function admin_can_create_a_user(): void
    {
        $response = $this->actingAsAdmin()->post('/admin/customers', [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => 'password',
        ]);

        // Check redirect or success status
        $response->assertRedirect(); // Web redirect to users.index
        $this->assertDatabaseHas('users', [
            'email' => 'customer@example.com',
            'name' => 'Test Customer',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_cannot_create_user_with_existing_email(): void
    {
        // Existing user
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAsAdmin()->post('/admin/customers', [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password',
        ]);

        // Check validation error
        $response->assertSessionHasErrors(['email']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_requires_name_email_password(): void
    {
        $response = $this->actingAsAdmin()->post('/admin/customers', []);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
