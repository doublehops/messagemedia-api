<?php

class BaseController
{
    public function sendResponse($object, $statusCode=200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);

        echo json_encode($object);

        exit;
    }

    public function sendBasicResponse($value, $statusCode=200)
    {
        http_response_code($statusCode);

        echo '"'. $value .'"';

        exit;
    }
}




function dd($message)
{
    die(var_dump($message));
}
