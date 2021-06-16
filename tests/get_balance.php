<?php

require __DIR__ . '/../vendor/autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//Get account balance and print it
echo $client->getBalance();

?>
