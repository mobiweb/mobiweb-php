# mobiweb-php

[![Packagist](https://img.shields.io/packagist/v/mobiweb/sdk.svg)](https://packagist.org/packages/mobiweb/sdk)
[![Packagist](https://img.shields.io/packagist/dt/mobiweb/sdk.svg)](https://packagist.org/packages/mobiweb/sdk)

A PHP library for interfacing with MobiWeb RESTful SMS API.

## Documentation

MobiWeb RESTful API can be found [here][apidocumentation].

## Versions

### Supported PHP Versions

This library supports the following PHP implementations:

* PHP 7.0
* PHP 7.2
* PHP 7.3
* PHP 7.4
* PHP 8.0

## Installation

* Download Source 
* Composer require [`mobiweb/sdk`](https://packagist.org/packages/mobiweb/sdk)

```
composer require mobiweb/sdk
```

## API Account

With MobiWeb SMS API you can send SMS messages to 7+ billion subscribers of 1000+ Mobile Operators in 200+ countries.

The SMS API is based on REST. It uses built-in HTTP authentication and HTTP status codes. All data exchange is done in JSON format.

To test the SMS API, you will need a valid API account. If you don't have one yet, [click here][apiaccount] to register for a FREE account.

## Examples

### Send a single SMS

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

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
```

### Send multiple SMS

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

$message = $client->broadcast(
    [[
        "from" => "HelloEx1", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
        "to" => ["44xxxxxxxxxx"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello from MobiWeb 1!" //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.

    ],
    [
        "from" => "HelloEx2",
        "to" => ["44xxxxxxxxxx"],
        "message" => "Hello from MobiWeb 2!"

    ]]
  );

//Print message
print_r($message);

?>
```

### Send SMS to multiple recipients

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

$message = $client->broadcast(
    [[
        "from" => "HelloWorld", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
      "to" => ["44xxxxxxxxx0","44xxxxxxxxx1"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello to multiple recipients!" //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.

    ]]
  );

//Print message
print_r($message);

?>
```

### Send SMS with all options

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

$message = $client->broadcast(
    [[
      "from" => "HelloWorld", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
      "to" => ["44xxxxxxxxxx"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello from MobiWeb!", //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.

      "options" => [
        "receive_dlr" => "1", //Set this parameter to ‘1’ for requesting delivery report for this SMS. Refer to receive Delivery Reports section for more information . https://api.solutions4mobiles.com/sms-api.html#receive_delivery_reports
        "message_type" => "sms", //The type of the SMS message.
        "track_url" => "0", //Set this parameter to ‘1’ to shorten and track URL link for this SMS. Refer to receive URL tracking and conversion section for more information . https://api.solutions4mobiles.com/sms-api.html#receive_url_ctr
        "reference_code" => "ABCD1234", //Set this parameter to your preferred reference id / custom data for this submission. Length can be up to 50 characters.
        "schedule_date" => "", //Set this parameter in format "yyyy-mm-dd hh:mm:ss" UTC +0 to schedule your sending to a future datetime. Must be at least 20 minutes from now.
        "expire_date" => "" //Set this parameter in format "yyyy-mm-dd hh:mm:ss" UTC +0 to force expiration of your SMS to a future datetime. Must be at least 30 minutes from now and schedule_date.
      ]

    ]]
  );

//Print message
print_r($message);

?>
```

### Send SMS with shortened URL and URL tracking enabled

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

$message = $client->broadcast(
    [[
      "from" => "HelloURL", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
      "to" => ["44xxxxxxxxxx"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello from https://www.solutions4mobiles.com", //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.
      "options" => [
        "track_url" => "1" //Set this parameter to ‘1’ to shorten and track URL link for this SMS. Refer to receive URL tracking and conversion section for more information . https://api.solutions4mobiles.com/sms-api.html#receive_url_ctr
      ]

    ]]
  );

//Print message
print_r($message);

?>
```

### Schedule SMS

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

$message = $client->broadcast(
    [[
      "from" => "HelloSche", //The sender displayed upon the SMS arrival. Can be composed of 2-11 alphanumeric characters (A-z,0-9, ,-,.) or 14 numeric characters (0-9). Special characters are not allowed.
      "to" => ["44xxxxxxxxxx"], //The full international number(s) of the recipient(s) in international E.164 format https://en.wikipedia.org/wiki/E.164.
      "message" => "Hello from scheduled message!".date("d/m/Y H:i:s"), //The text of the SMS message. If all characters in the message belong to the 3GPP GSM 7-bit GSM 03.38 ASCII character table https://en.wikipedia.org/wiki/GSM_03.38#GSM_7-bit_default_alphabet_and_extension_table_of_3GPP_TS_23.038_/_GSM_03.38, you can send up to 160 characters in a single SMS. You can send longer messages automatically by setting message parameter with your preffered text. In long SMS (multi-part SMS), each SMS part can be up to 153 characters. Each part costs as 1 SMS. If one or more characters in the message belong to the 16-bit Unicode / UCS-2 character table https://en.wikipedia.org/wiki/UTF-16, because of the increased memory requirement for each character, you can send up to 70 characters in a single SMS. In long SMS (multi-part SMS), each SMS part can be up to 67 characters. Each part costs as 1 SMS.
      "options" => [
        "schedule_date" => "2021-06-16 13:06:00" //Set this parameter in format "yyyy-mm-dd hh:mm:ss" UTC +0 to schedule your sending to a future datetime. Must be at least 20 minutes from now.
      ]

    ]]
  );

//Print message
print_r($message);

?>
```

### Receive delivery reports

Delivery reports are forwarded automatically, to the user system / platform. When an SMS delivery report is received by our SMS API Platform, the DLR information is immediately forwarded to your specified DLR Callback URL via a POST request. You can setup your DLR Callback URL in the [web portal][webpanel].

```php
<?

//For information about receiving delivery reports please visit https://api.solutions4mobiles.com/sms-api.html#receive_delivery_reports

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
```

### Receive URL tracking and conversion information

URL tracking information is forwarded automatically, to the user system / platform. When a user clicks a link, the CTR and user information is immediately forwarded to your specified Callback URL via a POST request. You can setup your Callback URL in the [web portal][webpanel].

```php
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
```

## Getting help

If you need help installing or using the library, please [contact us][MobiWebSupportCenter].

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocumentation]: https://api.solutions4mobiles.com/sms-api.html
[apiaccount]: https://www.solutions4mobiles.com/product/sms-messaging
[webpanel]: https://sms.solutions4mobiles.com
[MobiWebSupportCenter]: https://www.solutions4mobiles.com/support