<?

//For information about receiving url tracking and conversion information please visit https://api.solutions4mobiles.com/sms-api.html#receive_url_ctr

//Get request
$inputJSON = file_get_contents('php://input');

//convert JSON into array
$input= json_decode( $inputJSON, TRUE );

//print data
print_r($input);

//Return successful http code
header('HTTP/1.1 200 OK', true, 200);
// or error
// header('HTTP/1.1 500 Internal Server Error', true, 500);

?>