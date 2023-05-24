<?php

namespace App\Exceptions\Api;

use Exception;

class ApiSuccessException extends Exception
{
    public $message = '';

    public function __construct($message = 'Success')
    {
        $this->message = $message;
    }
}
