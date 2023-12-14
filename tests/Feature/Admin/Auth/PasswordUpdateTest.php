<?php

namespace Admin\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

   public function test_password_can_be_updated(): void
   {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

       $response = $this
           ->put(route('admin.password.update'), [
               'current_password' => 'password',
               'password' => 'new-password',
               'password_confirmation' => 'new-password',
           ]);

       $response->assertCreated();

       $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
   }

   public function test_correct_password_must_be_provided_to_update_password(): void
   {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

       $response = $this
           ->put(route('admin.password.update'), [
               'current_password' => 'wrong-password',
               'password' => 'new-password',
               'password_confirmation' => 'new-password',
           ]);

       $response->assertStatus(422);
       $this->assertArrayHasKey('errors', $response->json());

   }
}
