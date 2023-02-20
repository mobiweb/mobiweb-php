<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\Client as APIClient;

//Your account username and password
$username = "";
$password = "";

$client = new APIClient($username, $password);

//HLR lookup for a mobile number
$lookup = $client->lookup(
  "44xxxxxxxxxx" //The mobile number in international E.164 format.
  );

//Print the HLR lookup result
print_r($lookup);

?>