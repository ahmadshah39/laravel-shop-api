<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->success(
                data:null,
                message: "Email is already verified",
                code:201
            );
        }

        $request->user()->sendEmailVerificationNotification();

        return  $this->success(
            data:null,
            message: "An Email has been sent to your email id",
            code:201
        );
    }
}
