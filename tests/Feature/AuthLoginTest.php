<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_user_can_login_with_registered_admin_email(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin Barbearia',
            'email' => 'admin@barbearia.com',
            'password' => bcrypt('pwapwa'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@barbearia.com',
            'password' => 'pwapwa',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user, 'web');
    }
}
