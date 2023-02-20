<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Message;
use MobiWeb\Rest\Utility as Util;

class Client {

    protected $auth;
    const API_ENDPOINT = "https://sms.solutions4mobiles.com/apis"; 
    const HLR = "hlr"; 
    const SMS = "sms";


    public function __construct(string $username = null, string $password = null){

        if (!$username || !$password) {
            throw new \Exception("Username and Password are required to create a Client");
        }

        $this->auth = new Auth($username,$password);
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

    public function lookup(string $mobile): array{

        if (!$mobile) {
            throw new \Exception("Mobile number is required to make a HLR Lookup");
        }

        return HLR::lookup($this->auth, $mobile);

    }

    public function getBalance(): float{

        return Util::getBalance($this->auth);

    }

    public function getPricing(string $service=Client::SMS): array{

        return Util::getPricing($this->auth,$service);

    }

}

?>