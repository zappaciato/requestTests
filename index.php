<?php

include 'Request.php';

$firstRequest = new Request();

$firstRequest->address = 'www.google.pl';

try {
    $firstRequest->sendRqs();
} catch (Exception $e) {
    echo $e->getMessage();
}