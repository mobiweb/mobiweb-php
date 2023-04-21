# mobiweb-php

![GitHub release (latest by date)](https://img.shields.io/github/v/release/mobiweb/mobiweb-php)
![Packagist Downloads](https://img.shields.io/packagist/dt/mobiweb/sdk?label=Packagist)
![GitHub all releases](https://img.shields.io/github/downloads/mobiweb/mobiweb-php/total?label=GitHub)
![GitHub repo size](https://img.shields.io/github/repo-size/mobiweb/mobiweb-php)
![GitHub top language](https://img.shields.io/github/languages/top/mobiweb/mobiweb-php)
![GitHub](https://img.shields.io/github/license/mobiweb/mobiweb-php)

A PHP library for interfacing with MobiWeb RESTful SMS, HLR and OTP APIs.

## Documentation

MobiWeb RESTful APIs can be found [here][apidocumentation].

## Versions

### Supported PHP Versions

This library supports the following PHP implementations:

* From PHP 7.0 up to PHP 8.2

## Installation

* Download Source 
* composer require [`mobiweb/sdk`](https://packagist.org/packages/mobiweb/sdk)

```
composer require mobiweb/sdk
```

## API Account

* With MobiWeb SMS API you can send SMS messages to 7+ billion subscribers of 1000+ Mobile Operators in 200+ countries.
* With MobiWeb HLR API you can maximize the performance of your campaigns and your business communication. Validate mobile number databases, remove invalid entries and receive correct portability information, identifying the operators that the mobile numbers belong to.
* With MobiWeb OTP API you can provide additional security to simple username and password authentication, authenticated transactions, accurately verify users, reduce fraud and reduce two-factor authentication cost (no hardware tokens required).

The APIs are based on REST with built-in HTTP authentication and HTTP status codes. All data exchange is done in JSON format.

To test the APIs, you will need a valid API account. If you don't have one yet, [click here][apiaccount] to register for a FREE account.

## Examples

### SMS API
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

### Get account balance

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account balance and print it
echo $client->getBalance();

?>
```

### Get account pricing

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account pricing and print it
print_r($client->getPricing(MobiWeb\Rest\Client::SMS));

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

### HLR API
### Lookup a mobile number

```php
<?

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//HLR lookup for a mobile number
$lookup = $client->lookup(
  "44xxxxxxxxxx" //The mobile number in international E.164 format.
  );

//Print the HLR lookup result
print_r($lookup);

?>
```

### Get account balance

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account balance and print it
echo $client->getBalance();

?>
```

### Get account pricing

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account HLR pricing and print it
print_r($client->getPricing(MobiWeb\Rest\Client::HLR));

?>
```

### OTP SMS API
### Generate and send OTP

```php
<?

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

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
```

### Validate OTP

```php
<?

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Validate a previously generated OTP with the OTP ID. OTP is provided by the mobile number subscriber.
$otp = $client->validate(
  "564xxx", //The OTP ID returned by the generated OTP.
  "44xxxxxxxxxx", //The mobile number of the subscriber in international E.164 format.
  "265xxx", //The OTP provided by the mobile number subscriber. 
);

//Print the OTP validation attempt result. If result is TRUE, OTP is validated.
echo $otp;

?>
```

### Get account balance

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account balance and print it
echo $client->getBalance();

?>
```

### Get account pricing

```php
<?php

//Your account username and password
$username = "";
$password = "";

$client = new MobiWeb\Rest\Client($username, $password);

//Get account OTP pricing and print it
print_r($client->getPricing(MobiWeb\Rest\Client::OTP));

?>
```

## Getting help

If you need help installing or using the library, please [contact us][MobiWebSupportCenter].

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocumentation]: https://api.solutions4mobiles.com/sms-api.html
[apiaccount]: https://www.solutions4mobiles.com/product/sms-messaging
[webpanel]: https://sms.solutions4mobiles.com
[MobiWebSupportCenter]: https://www.solutions4mobiles.com/support
