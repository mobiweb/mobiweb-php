<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//Validate a previously generated OTP with the OTP ID. OTP is provided by the mobile number subscriber.
$otp = $client->validate(
  "564xxx", //The OTP ID returned by the generated OTP.
  "44xxxxxxxxxx", //The mobile number of the subscriber in international E.164 format.
  "265xxx", //The OTP provided by the mobile number subscriber. 
);

//Print the OTP validation attempt result. If result is TRUE, OTP is validated.
echo $otp;

?>