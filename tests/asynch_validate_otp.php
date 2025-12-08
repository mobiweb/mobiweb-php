<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

//Endpoint Options:
//  APIClient::API_ENDPOINT - REST API (SMS, OTP, HLR) - Default
//  APIClient::SMPP_API_1_ENDPOINT - Asynchronous SMS API (SMS), Asynchronous OTP API
//  APIClient::SMPP_API_2_ENDPOINT - Asynchronous SMS API (SMS), Asynchronous OTP API - Alternative
$endpoint = APIClient::SMPP_API_1_ENDPOINT;

$client = new APIClient($username, $password, $endpoint);

//Validate a previously generated OTP with the OTP ID. OTP is provided by the mobile number subscriber.
$otp = $client->validate(
  "8f3c1d7ab924e0fb6c52d9a41ef0837a", //The OTP ID returned by the generated OTP.
  "44xxxxxxxxxx", //The mobile number of the subscriber in international E.164 format.
  "265xxx", //The OTP provided by the mobile number subscriber. 
);

//Print the OTP validation attempt result. If result is TRUE, OTP is validated.
echo $otp;

?>