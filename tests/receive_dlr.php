<?
//Get data
$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array

//print data
print_r($input);

//ToDo- Handle and store data

//Return successful result
header('HTTP/1.1 200 OK', true, 200);
// or error
// header('HTTP/1.1 500 Internal Server Error', true, 500);
?>