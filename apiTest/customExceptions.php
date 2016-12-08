<?php

class ResponseException extends Exception{

    protected $statusCode;

    public function __construct($statusCode, $message, $code = 0, Exception $previous = null) {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

}


class ValidationError extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}


?>