<?php

use App\Http\Controllers\Api\V1\Client\Auth\AuthenticatedTokenController;
use App\Http\Controllers\Api\V1\Client\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Api\V1\Client\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\V1\Client\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Client\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Client\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\V1\Client\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Client\Auth\VerifyEmailController;
use App\Http\Controllers\Api\V1\Client\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware'=>'auth:sanctum', 'prefix' => 'client'],function () {

    Route::group(['middleware'=> ['verified']], function (){
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('client.user');
    });

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('client.verification.send');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('client.verification.verify');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])->name('client.confirmPassword');

    Route::put('password', [PasswordController::class, 'update'])->name('client.password.update');

    Route::post('logout', [AuthenticatedTokenController::class, 'destroy'])
        ->name('client.logout');
});




Route::group(['middleware'=>'guest', 'prefix' => 'client'], function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('client.register');
    Route::post('login', [AuthenticatedTokenController::class, 'store'])->name('client.login');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('client.password.email');
    Route::post('reset-password/{token}', [NewPasswordController::class, 'store'])
        ->name('client.password.store');
});
