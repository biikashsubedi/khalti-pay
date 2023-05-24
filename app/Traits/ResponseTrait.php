<?php

namespace App\Traits;

use Config;
use Illuminate\Support\Facades\Request;
use function App\Traits\Api\isAppApiKey;
use function App\Traits\Api\isSystemApiKey;
use function App\Traits\Api\isWebApiKey;

trait ResponseTrait
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param null $key
     * @param      $message
     * @param null $titleMessage
     * @return mixed
     */
    protected function respondWithError($message, $code = null, $key = null, $titleMessage = null, $changeCode = false)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                'You better have a really good reason for erroring on a 200...',
                E_USER_WARNING
            );
        }
        if ($key != null) {
            $pointer = 'pointer';
            $error['source'] = $pointer . '":' . '"' . '/data/attributes/' . $key;
            $error['code'] = trans('code.' . $key);
        } else {
            $error['code'] = $changeCode ? $code : $this->statusCode;
        }

        $error['title'] = is_null($titleMessage) ? $message : $titleMessage;

        $error['detail'] = $message;
        $jsonApiError['errors'][] = $error;

        return $this->metaEncode($jsonApiError);
    }

    public function respondWithSuccess($message = 'OK')
    {
        $data['data'] = [
            'message' => $message,
        ];

        return $this->metaEncode($data);
    }

    public function userUnauthenticated($message = 'Unauthenticated')
    {
        $data['error'] = [
            'code' => $this->statusCode ?? 404,
            'title' => $message,
            'detail' => $message,
        ];

        return $this->metaEncode($data);
    }

    protected function metaEncode($response, $meta = null)
    {
        $json1 = json_encode($response);
        $meta = $meta ? array_merge(Config::get('constants.META'), ['meta' => $meta]) : Config::get('constants.META');
        $meta = json_encode($meta);
        $array1 = json_decode($json1, true);
        $array2 = json_decode($meta, true);
        if (isset($this->related)) {
            $array2['meta']['related'] = $this->related;
        }
        if (isset($this->filters)) {
            $array2['meta']['filters'] = $this->filters;
        }
        if (isset($this->userDefault)) {
            $array2['meta']['imagePlaceholder']['userDefault'] = $this->userDefault->value;
        }
        if (isset($this->notice)) {
            $array2['meta']['notice'] = $this->notice;
        }

        if (isset($this->appLayoutData)) {
            $array2['meta']['appLayoutData'] = $this->appLayoutData;
        }

        $data = array_merge_recursive($array2, $array1);
        return $this->respondWithArray($data);
    }

    /**
     * @param array $array
     * @param array $headers
     * @return \Illuminate\Http\Response
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        $contentType = 'application/json';
        $content = json_encode($array);
        $response = response()->make($content, $this->statusCode, $headers);

        $response->header('Content-Type', $contentType);

        return $response;
    }

    protected function responseOfArray($response = [], $format = 'data')
    {
        if ($format === 'data') {
            $jsonApiError[$format] = $response;
        } else {
            $jsonApiError[$format][] = $response;
        }

        return $this->metaEncode($jsonApiError);
    }
}
