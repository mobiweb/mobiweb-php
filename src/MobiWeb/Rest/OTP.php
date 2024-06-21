<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Client as APIClient;
use MobiWeb\Http\Client as HttpClient;
use MobiWeb\Rest\Error as APIError;

class OTP {

    const GENERATE_ENDPOINT = "/otp/v3/generate";
    const VALIDATE_ENDPOINT = "/otp/v3/validate/";
    const OTP_METHOD = "POST";

    public static function generate(Auth $auth = null, string $mobile, string $sender = "SECUREPIN", string $message = "Please do not share your password pin. Your password pin is: [PIN]", int $validity = 600): array{

        if (!$auth) {
            throw new \Exception("Cannot generate OTP without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $body = new \stdClass();
        $body->mobile = $mobile;
        $body->sender = $sender;
        $body->message = $message;
        $body->validity = $validity;

        $executedRequest=$http->request(APIClient::API_ENDPOINT . OTP::GENERATE_ENDPOINT, OTP::OTP_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_CREATED){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
        }

        return array($executedRequest->response->body->payload);
    }

    public static function validate(Auth $auth = null, string $id, string $mobile, string $pin): bool{

        if (!$auth) {
            throw new \Exception("Cannot validate OTP without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $body = new \stdClass();
        $body->mobile = $mobile;
        $body->pin = $pin;

        $executedRequest=$http->request(APIClient::API_ENDPOINT . OTP::VALIDATE_ENDPOINT . $id, OTP::OTP_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
        }

        return true;

    }

}