<?php

include 'Request.php';
include 'Logger.php';

// $url = "https://www.google.co.uk/search?q=cow";
$url = 'https://jsonplaceholder.typicode.com/todos/1';
$httpMethod = "GET";


$firstRequest = new Request();
$firstRequest->url = $url;
$firstRequest->httpMethod = $httpMethod;
$firstRequest->port = $firstRequest->getCurrentPort($url);

// $log = new Logger(); nie musimy jej instantiate bo metody sa static
// print_r(Logger::info('THis is info from the Logger'));
// Logger::debug($firstRequest);

try {
    $firstRequest->sendRqs();
} catch (Exception $e) {
    echo $e->getMessage();
}