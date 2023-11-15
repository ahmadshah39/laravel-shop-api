<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = $this->verifyAndGenerateToken($request->email);

        return $this->success(
            data:[
                'status' => __($status)
            ],
            message: 'Request was successfull',
            code:$status == 'success' ? 200 : 401,
        );
    }

    /**
     * @return DatabaseTokenRepository
     */
    public function getTokenRepository(): DatabaseTokenRepository
    {
        $app = app();
        $driver = $app['config']['auth.defaults.passwords'];
        $config = $app['config']["auth.passwords.{$driver}"];

        $key = $app['config']['app.key'];
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        $connection = $config['connection'] ?? null;

        return new DatabaseTokenRepository(
            $app['db']->connection($connection),
            $app['hash'],
            $config['table'],
            $key,
            $config['expire'],
            $config['throttle'] ?? 0
        );
    }

    public function verifyAndGenerateToken($email): string
    {
        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return 'user.not_found';
        }

        $tokenRepo = $this->getTokenRepository();

        // check if token has been recently created
        if ($tokenRepo->recentlyCreatedToken($user)) {
            return 'reset.alreadySent';
        }

        $token = $tokenRepo->create($user);
        $user->sendPasswordResetNotification($token);
        return 'reset.sent';
    }
}
