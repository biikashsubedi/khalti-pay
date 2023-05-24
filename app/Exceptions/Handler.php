<?php

namespace App\Exceptions;

use App\Exceptions\Api\ApiGenericException;
use App\Exceptions\Api\ApiGenericExceptionWithCode;
use App\Exceptions\Api\ApiSuccessException;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ResponseTrait;

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
    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->setStatusCode(403)->respondWithError("method not allowed.");
        }

        if ($e instanceof ApiGenericException) {
            return $this->setStatusCode($e->statusCode)->respondWithError($e->message);
        }

        if ($e instanceof ApiGenericExceptionWithCode) {
            return $this->setStatusCode($e->statusCode)->respondWithError($e->message, $e->code, null, null, true);
        }

        if ($e instanceof ApiSuccessException) {
            return $this->respondWithSuccess($e->message);
        }

        if ($e instanceof ThrottleRequestsException) {
            return $this->setStatusCode($e->getStatusCode())->respondWithError($e->getMessage());
        }

        if ($e instanceof PostTooLargeException) {
            return redirect()->back()->withErrors(['alert-danger' => 'File Too Large.']);
        }

        return parent::render($request, $e);
    }
}
