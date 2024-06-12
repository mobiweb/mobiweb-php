<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\AsynchClient as AsynchClient;

//Your account username and password
$username = "";
$password = "";

$client = new AsynchClient($username, $password);

//Get account SMS pricing and print it
print_r($client->getPricing(AsynchClient::SMS));

?>
