<?php

require __DIR__ . '/../vendor/autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//Get account pricing and print it
print_r($client->getPricing());

?>
