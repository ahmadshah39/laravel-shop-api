<?php

use App\Http\Controllers\Api\V1\Admin\Auth\AuthenticatedTokenController;
use App\Http\Controllers\Api\V1\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Api\V1\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\V1\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Admin\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\V1\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Admin\Auth\VerifyEmailController;
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


Route::middleware(['auth:sanctum'])->group(function () {

    Route::group(['middleware'=> ['verified']], function (){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
    
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedTokenController::class, 'destroy'])
        ->name('logout');
});




Route::middleware('guest')->group(function () {

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::post('login', [AuthenticatedTokenController::class, 'store'])->name('login');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::post('reset-password/{token}', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

