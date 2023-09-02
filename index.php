<?php

include 'Request.php';
include 'Log.php';

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
// echo 'log_errors = ' . ini_get('log_errors') . "\n";

// trigger_error("A user requested a resource.", E_USER_NOTICE);
// trigger_error("The image failed to load!", E_USER_WARNING);
// trigger_error("User requested a profile that doesn't exist!", E_USER_ERROR);