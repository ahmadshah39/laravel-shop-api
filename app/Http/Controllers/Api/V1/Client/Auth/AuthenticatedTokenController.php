<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthenticatedTokenController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer || !Hash::check($request->password, $customer->password)) {
            RateLimiter::hit($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($request->throttleKey());

       $token = $customer->createToken('api', ['role:admin'])->plainTextToken;

        return $this->success(
            data:[
                'customer' => $customer,
                'token' => $token,
            ],
            message: 'Customer successfully logged in',
            code: 200
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {

        $request->customer()->currentAccessToken()->delete();

        return $this->success(
            data:null,
            message: 'Customer successfully logged out',
            code: 401
        );
    }
}
