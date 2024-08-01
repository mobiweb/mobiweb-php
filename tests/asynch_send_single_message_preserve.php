<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;


//Your account username and password
$username = "";
$password = "";

//Preserve an access_token if it already exists and it is not expired. Used when multiple nodes use the same account to access the API.
$preserve=true;

//Endpoint Options:
//  APIClient::API_ENDPOINT - REST API (SMS, OTP, HLR) - Default
//  APIClient::SMPP_API_1_ENDPOINT - Asynchronous SMS API (SMS)
//  APIClient::SMPP_API_2_ENDPOINT - Asynchronous SMS API (SMS) - Alternative
$endpoint = APIClient::SMPP_API_1_ENDPOINT;

$client = new APIClient($username, $password, $endpoint, $preserve);

//Submit message
$message = $client->broadcast(
    [[
      "from" => "HelloWorld", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
      "to" => ["44xxxxxxxxxx"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello from MobiWeb!" //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.

    ]]
  );

//Print message
print_r($message);

?>