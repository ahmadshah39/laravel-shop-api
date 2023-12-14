<?php

namespace Admin\Auth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;


   public function test_password_can_be_confirmed(): void
   {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

       $response = $this->post(route('admin.confirmPassword'), [
           'password' => 'password',
       ]);

       $response->assertCreated();
   }

   public function test_password_is_not_confirmed_with_invalid_password(): void
   {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

       $response = $this->postJson(route('admin.confirmPassword'), [
           'password' => 'wrong-password',
       ]);


       $response->assertStatus(422);

       $this->assertArrayHasKey('errors', $response->json());
   }
}
