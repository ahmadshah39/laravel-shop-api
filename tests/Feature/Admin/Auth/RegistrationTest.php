<?php

namespace Admin\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {

        $this->postJson(route('admin.register'),[
            'name' => 'Test User',
            'user_name' => 'TestUserName',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertCreated();

        $this->assertDatabaseHas('users',['email' => 'test@example.com']);
    }
}
