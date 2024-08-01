<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Message;
use MobiWeb\Rest\HLR;
use MobiWeb\Rest\OTP;
use MobiWeb\Rest\Utility as Util;

class Client {

    protected $auth;
    protected $endpoint;
    const API_ENDPOINT = "https://sms.solutions4mobiles.com/apis";
    const SMPP_API_1_ENDPOINT = "https://apix.solutions4mobiles.com/apis";
    const SMPP_API_2_ENDPOINT = "https://apix2.solutions4mobiles.com/apis";
    const HLR = "hlr"; 
    const SMS = "sms";
    const OTP = "otp";


    public function __construct(string $username = null, string $password = null, string $endpoint = Client::API_ENDPOINT, bool $preserve = false){

        if (!$username || !$password) {
            throw new \Exception("Username and Password are required to create a Client");
        }

        $this->auth = new Auth($username,$password,$endpoint,$preserve);
        if(!$this->auth->authenticate()){
            throw new \Exception("Authentication failed");
        }

        $this->endpoint = $endpoint;

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

        if($this->endpoint != Client::API_ENDPOINT) {
            throw new \Exception("Unsupported service for selected endpoint");
        }

        return OTP::generate($this->auth, $mobile, $sender, $message, $validity);

    }

    public function validate(string $id, string $mobile, string $pin): bool{

        if (!$mobile || !$id || !$pin) {
            throw new \Exception("Mobile number, OTP pin and OTP ID is required to validate an OTP");
        }

        if($this->endpoint != Client::API_ENDPOINT) {
            throw new \Exception("Unsupported service for selected endpoint");
        }

        return OTP::validate($this->auth, $id, $mobile, $pin);

    }

    public function lookup(string $mobile): array{

        if (!$mobile) {
            throw new \Exception("Mobile number is required to make a HLR Lookup");
        }

        if($this->endpoint != Client::API_ENDPOINT) {
            throw new \Exception("Unsupported service for selected endpoint");
        }

        return HLR::lookup($this->auth, $mobile);

    }

    public function getBalance(): float{

        return Util::getBalance($this->auth);

    }

    public function getPricing(string $service=Client::SMS): array{

        if($this->endpoint != Client::API_ENDPOINT && $service != Client::SMS) {
            throw new \Exception("Unsupported service for selected endpoint");
        }

        return Util::getPricing($this->auth,$service);

    }

}