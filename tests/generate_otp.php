<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//Generate OTP and send it via SMS to a mobile number
$otp = $client->generate(
  "44xxxxxxxxxx", //The mobile number in international E.164 format.
  "SECUREPIN", //The sender that will be displayed in the OTP SMS. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
  "Please do not share your password pin. Your password pin is: [PIN]", //The text message of OTP SMS. Remember to put placeholder [PIN] in the message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table, you can send up to 160 characters. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table, because of the increased memory requirement for each character, you can send up to 70 characters. 
  600, //The validity period of the pin in seconds. The default value is 600 seconds (10 minutes).
  );

//Print the generate OTP result. Remember to store the mobile number and the OTP id for later use.
print_r($otp);

?>