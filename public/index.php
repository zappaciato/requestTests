<?php

namespace Kris\TestProject;

use Kris\TestProject\Classes\Request;
use Kris\TestProject\Classes\Log;
use Kris\TestProject\Classes\Request as TestProjectRequest;

include '../src/Classes/Request.php';
// // include 'originalReq.php';
// include '../src/Classes/Log.php';

$url = "https://www.google.co.uk/search?q=cow";
// $url = 'https://jsonplaceholder.typicode.com/todos/1';
// $url = '';
$httpMethod = "POST";


$firstRequest = new Request();
$firstRequest->url = $url;
$firstRequest->httpMethod = $httpMethod;
// $firstRequest->updatePort();
// $firstRequest->displayCurrentData();
// $firstRequest->port = $firstRequest->updatePort($url);


try {
    $firstRequest->sendRqs();
} catch (Exception $e) {
    echo $e->getMessage();
}
