<?php

namespace MobiWeb\Rest;

use MobiWeb\Http\Client as HttpClient;
use MobiWeb\Rest\Error as APIError;

class Authentication {

    const TYPE_ACCESS = "access_token";
    const TYPE_REFRESH = "refresh_token";
    const AUTH_ENDPOINT = "/auth";
    const AUTH_METHOD = "POST";
    const REFRESH_ENDPOINT = "/auth";
    const REFRESH_METHOD = "POST";
    const VALIDITY_PERIOD = 1800;
    const VALIDITY_THRESHOLD = 30;

    protected $username;
    protected $password;
    protected $access_token;
    protected $refresh_token;
    protected $timestamp;
    protected $endpoint;


    public function __construct(string $username = null, string $password = null, string $endpoint){

        if (!$username || !$password) {
            throw new \Exception("Username and Password are required to authenticate");
        }

        $this->username=$username;
        $this->password=$password;
        $this->endpoint=$endpoint;
    }

    public function authenticate() :bool{

        $http = new HttpClient();
        $headers = array();
        $body = new \stdClass();
        $body->username = $this->username;
        $body->password = $this->password;
        $body->type = Authentication::TYPE_ACCESS;
        $executedRequest=$http->request($this->endpoint . Authentication::AUTH_ENDPOINT, Authentication::AUTH_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
        }
        $this->timestamp = new \DateTime();
        $this->access_token = $executedRequest->response->body->payload->access_token;
        $this->refresh_token = $executedRequest->response->body->payload->refresh_token;

        return true;

    }

    public function refresh() :bool{

        if(!$this->refresh_token){
            throw new \Exception("Refresh_token is required to refresh connection");
        }

        $http = new HttpClient();
        $headers = array();
        $body = new \stdClass();
        $body->refresh_token = $this->refresh_token;
        $body->type = Authentication::TYPE_REFRESH;
        $executedRequest=$http->request($this->endpoint . Authentication::AUTH_ENDPOINT, Authentication::AUTH_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
        }
        $this->timestamp = new \DateTime();
        $this->access_token = $executedRequest->response->body->payload->access_token;
        $this->refresh_token = $executedRequest->response->body->payload->refresh_token;

        return true;

    }

    public function getAccessToken(): string{

        if(!$this->isAuthenticated()){
            if(!$this->authenticate())return false;
        }

        return $this->access_token;

    }

    public function getEndPoint(): string{

        return $this->endpoint;

    }

    public function isAuthenticated() :bool{

        $timestamp = new \DateTime();
        $interval = $this->timestamp->diff($timestamp);
        if($interval->s >= Authentication::VALIDITY_PERIOD) return false;

        if(($interval->s < Authentication::VALIDITY_PERIOD) && ($interval->s >= (Authentication::VALIDITY_PERIOD - Authentication::VALIDITY_THRESHOLD))){
            if(!$this->refresh()){
                throw new \Exception("Refresh connection failed");
            }
        }


        return true;

    }

}