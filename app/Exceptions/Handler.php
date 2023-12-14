<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, \Throwable $exception): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($exception instanceof ValidationException) {
                return response()->json(['status' => 0, 'message' => $exception->getMessage(), 'errors' => $exception->validator->getMessageBag()], 422);
        }
//        if ($request->is('api/*')) {
//            return response()->json(['status' => 0, 'message' => $exception->getMessage() !== "" ? $exception->getMessage() : "Some Unknown Http Error",], 500);
//        }
        return parent::render($request, $exception);
    }
}
