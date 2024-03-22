<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
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

    public function render($request, Throwable $e)
    {
        if ($e->getMessage() == "Unauthenticated.") {
            return redirect('/admin');
        }
        $code = $e->getCode();
        $stat = 0;
        if ($code > 500) {
            $stat += 500;
        } elseif ($code == 0) {
            $stat += 200;
        }
        return response()->json([
            'statusCode' => $stat,
            'errors' => $e->getMessage(),
            'file' => [
                $e->getFile() => $e->getLine(),
            ]
        ], $stat);
    }
}
