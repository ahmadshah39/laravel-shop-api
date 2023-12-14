<?php

namespace Admin\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('admin.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk();

        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('token', $response->json()['data']);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('admin.login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->assertStatus(422);

        $this->assertArrayHasKey('message', $response->json());
    }

    public function test_users_can_logout(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->post(route('admin.logout'))->assertUnauthorized();
    }
}
