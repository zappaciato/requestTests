<?php

require '../vendor/autoload.php';

use Kris\TestProject\Classes\Request;
use Kris\TestProject\Classes\Database;

// $url = "https://www.google.co.uk/search?q=cow";
$url = 'https://jsonplaceholder.typicode.com/todos/1';
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


try {
    $user = "root";
    $host = "localhost";
    $pwd = "";
    $db_name = "testowa";
    $db = new Database($host, $user, $pwd, $db_name);
    $link = $db->connect();
    echo "Weszlo";
} catch (Exception $e) {
    // print_r($e);
    echo "Nie weszło";
}


$sqlQuery = "SELECT * from users";
$resultOutput = $link->query($sqlQuery);
print_r($resultOutput);
