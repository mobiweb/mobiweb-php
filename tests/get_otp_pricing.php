<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//Get account OTP pricing and print it
print_r($client->getPricing(APIClient::OTP));

?>
