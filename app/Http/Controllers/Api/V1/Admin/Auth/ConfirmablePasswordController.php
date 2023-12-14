<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): JsonResponse
    {

        if (!$request->user() || !Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        return $this->success(
            data:null,
            message: "Password confirmed successfully",
            code:201
        );
    }
}
