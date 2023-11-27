<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $errorIdentifier;
    protected $errorDetail;
    protected $errorCode;
    protected $errorMessage;

    public function __construct($errorIdentifier, $errorDetail, $message = null, $code = 0)
    {
        $this->errorIdentifier = $errorIdentifier;
        $this->errorDetail = $errorDetail;
        $this->errorCode = $code;
        $this->errorMessage = $message;
    }

    public function getErrorIdentifier()
    {
        return $this->errorIdentifier;
    }

    public function getErrorDetail()
    {
        return $this->errorDetail;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setIdentifier()
    {
        $this->errorIdentifier = '$errorIdentifier';
    }
}
