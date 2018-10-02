<?php

require __DIR__ .'/BaseController.php';

class PingController extends BaseController
{
}



$params = $_REQUEST;

$cont = new PingController;

$response = ['message' => 'Ping request received'];

$cont->sendResponse($response);
