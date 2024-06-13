<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Utility as Util;

class Client {

    protected $auth;
    private $apiEndpoint;
    const API_ENDPOINT_DEFAULT = "https://sms.solutions4mobiles.com/apis";
    const HLR = "hlr"; 
    const SMS = "sms";
    const OTP = "otp";


    public function __construct(string $username = null, string $password = null, string $apiEndpoint = self::API_ENDPOINT_DEFAULT){

        if (!$username || !$password) {
            throw new \Exception("Username and Password are required to create a Client");
        }

        $this->apiEndpoint = $apiEndpoint;

        $this->auth = new Auth($username,$password,$apiEndpoint);
        if(!$this->auth->authenticate()){
            throw new \Exception("Authentication failed");
        }

    }

    public function broadcast(array $args): array{

        if (!$args) {
            throw new \Exception("Message arguments are required to broadcast a message");
        }

        return Message::broadcast($this->auth, $args);

    }

    public function generate(string $mobile, string $sender, string $message, int $validity){

        if (!$mobile) {
            throw new \Exception("Mobile number is required to generate an OTP");
        }

        return OTP::generate($this->auth, $mobile, $sender, $message, $validity, $this->apiEndpoint);

    }

    public function validate(string $id, string $mobile, string $pin): bool{

        if (!$mobile || !$id || !$pin) {
            throw new \Exception("Mobile number, OTP pin and OTP ID is required to validate an OTP");
        }

        return OTP::validate($this->auth, $id, $mobile, $pin, $this->apiEndpoint);

    }

    public function lookup(string $mobile): array{

        if (!$mobile) {
            throw new \Exception("Mobile number is required to make a HLR Lookup");
        }

        return HLR::lookup($this->auth, $mobile, $this->apiEndpoint);

    }

    public function getBalance(): float{

        return Util::getBalance($this->auth);

    }

    public function getPricing(string $service=Client::SMS): array{

        return Util::getPricing($this->auth,$service);

    }

}