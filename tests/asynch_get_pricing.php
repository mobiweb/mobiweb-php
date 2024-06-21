<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

//Endpoint Options:
//  APIClient::API_ENDPOINT - REST API (SMS, OTP, HLR) - Default
//  APIClient::SMPP_API_OTP_ENDPOINT - Asynchronous SMS API (SMS) - For (one-time pins) OTP & Notification messages
//  APIClient::SMPP_API_MRK_ENDPOINT - Asynchronous SMS API (SMS) - For marketing messages
$endpoint = APIClient::SMPP_API_OTP_ENDPOINT;

$client = new APIClient($username, $password, $endpoint);

//Get account SMS pricing and print it
print_r($client->getPricing(APIClient::SMS));

?>
