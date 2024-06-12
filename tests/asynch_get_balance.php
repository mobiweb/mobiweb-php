<?php

require __DIR__ . '/../../../autoload.php'; // Loads MobiWeb package

use MobiWeb\Rest\AsynchClient as AsynchClient;

//Your account username and password
$username = "";
$password = "";

$client = new AsynchClient($username, $password);

//Get account balance and print it
echo $client->getBalance();

?>
