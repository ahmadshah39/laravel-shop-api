<?php

namespace Admin\Auth;

use App\Models\User;
use App\Notifications\Auth\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;



   public function test_reset_password_link_can_be_requested(): void
   {
       Notification::fake();

       $user = User::factory()->create();

       $this->post(route('admin.password.email'), ['email' => $user->email]);

       Notification::assertSentTo($user, ResetPassword::class);
   }

   public function test_password_can_be_reset_with_valid_token(): void
   {
       Notification::fake();

       $user = User::factory()->create();

       $this->post(route('admin.password.email'), ['email' => $user->email]);

       Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
           $response = $this->post(route('admin.password.store', ['token'=>$notification->token]), [
               'token' => $notification->token,
               'email' => $user->email,
               'password' => 'password',
               'password_confirmation' => 'password',
           ]);

           return true;
       });
   }
}
