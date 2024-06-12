<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Message;
use MobiWeb\Rest\Utility as Util;

class AsynchClient {

    protected $auth;
    const API_ENDPOINT = "https://apix.solutions4mobiles.com/apis"; 
    const SMS = "sms";


    public function __construct(string $username = null, string $password = null){

        if (!$username || !$password) {
            throw new \Exception("Username and Password are required to create a Client");
        }

        $this->auth = new Auth($username,$password,AsynchClient::API_ENDPOINT);
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

    public function getBalance(): float{

        return Util::getBalance($this->auth);

    }

    public function getPricing(string $service=Client::SMS): array{

        return Util::getPricing($this->auth,$service);

    }

}

?>