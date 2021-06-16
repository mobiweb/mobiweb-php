<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Client as APIClient;
use MobiWeb\Http\Client as HttpClient;
use MobiWeb\Rest\Error as APIError;

class Utility {

    const BALANCE_ENDPOINT = "/sms/mt/v2/balance";
    const BALANCE_METHOD = "GET";
    const PRICING_ENDPOINT = "/sms/mt/v2/pricing";
    const PRICING_METHOD = "GET";


    public static function getBalance(Auth $auth = null): float{

        if (!$auth) {
            throw new \Exception("Cannot get balance without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
            return false;
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $executedRequest=$http->request(APIClient::API_ENDPOINT . Utility::BALANCE_ENDPOINT, Utility::BALANCE_METHOD, $headers);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
            return false;
        }

        return floatval($executedRequest->response->body->payload->balance);

    }

    public static function getPricing(Auth $auth = null): array{

        if (!$auth) {
            throw new \Exception("Cannot get pricing without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
            return false;
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $executedRequest=$http->request(APIClient::API_ENDPOINT . Utility::PRICING_ENDPOINT, Utility::PRICING_METHOD, $headers);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
            return false;
        }

        $currency = $executedRequest->response->body->payload->currency->symbol;

        $pricing = $executedRequest->response->body->payload->pricing;

        $arr_pricing=array();

        foreach ($pricing as $key => $value)$arr_pricing[$value->id] = array("countryname" => $value->operatorname, "operator" => $value->operatorname, "mcc" => $value->mcc, "mnc" => $value->mnc, "price" => $value->price, "currency" => $currency);



        return $arr_pricing;

    }

}

?>