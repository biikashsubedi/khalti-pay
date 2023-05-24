<?php

namespace App\Http\Middleware\Api;

use App\Models\ApiKey;
use App\Traits\ResponseTrait;
use Closure;
use Config;
use Illuminate\Http\Request;

class AuthenticateApiKey
{
    use ResponseTrait;

    const UNAUTHENTICATEAPICODE = 120;
    const EMPTYAPICODE = 121;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Api-Key')) {
            $key = $request->header('Api-Key');
            $keyResponse = (new ApiKey())->getApiKey($key);
            if ($keyResponse) {
                $request->headers->set('platform', $keyResponse->type, true);
                Config::set('runtime.platform', $keyResponse->type);
                $keyResponse->increment('hits');

                return $next($request);
            }

            return $this->hasError('Api Key Mismatch.', self::UNAUTHENTICATEAPICODE);
        } else {
            return $this->hasError('Empty Api Key.', self::EMPTYAPICODE);
        }
    }

    protected function hasError($message = 'Api Key Error', $code = '')
    {
        return $this->setStatusCode(404)
            ->respondWithSuccess($message, $code);
    }

    protected function respondWithSuccess($message, $code)
    {
        $data['data'] = [
            'message' => $message,
            'code' => $code,
        ];

        return $this->metaEncode($data);
    }
}
