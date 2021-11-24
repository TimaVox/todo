<?php

namespace Todo;

class ErrorHandler
{
    public function __construct(){
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e)
    {
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404)
    {
        http_response_code($responce);
        if(DEBUG) {
            echo sprintf("%s \"%s\" - %s [%d][code=%d]", $errno, $errstr, $errfile, $errline, $responce);
            die;
        }
        require ROOT . '/app/views/errors/' . $responce . '.php';
        die;
    }
}