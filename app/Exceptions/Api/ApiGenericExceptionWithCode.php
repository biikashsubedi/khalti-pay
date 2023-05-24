<?php

namespace App\Exceptions\Api;

use Exception;

class ApiGenericExceptionWithCode extends Exception
{
    public $message = '';
    public $code = '';
    public $statusCode = '';

    public function __construct($message = 'Something went wrong', $statusCode = 401, $code = 100)
    {
        $this->code = $code;
        $this->message = $message;
        $this->statusCode = $statusCode;
    }
}
