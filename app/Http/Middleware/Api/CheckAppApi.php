<?php

namespace App\Http\Middleware\Api;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class CheckAppApi
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isAndroidApiKey() || isIosApiKey()) {
            return $next($request);
        } else {
            return $this->setStatusCode(401)->userUnauthenticated('Api Key Mismatched.');
        }
    }
}
