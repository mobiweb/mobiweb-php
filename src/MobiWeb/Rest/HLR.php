<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Client as APIClient;
use MobiWeb\Http\Client as HttpClient;
use MobiWeb\Rest\Error as APIError;

class HLR {

    const HLR_ENDPOINT = "/hlr/v2/";
    const HLR_METHOD = "GET";


    public static function lookup(Auth $auth = null, string $mobile): array{

        if (!$auth) {
            throw new \Exception("Cannot query mobile number without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
            return false;
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $body="";

        $executedRequest=$http->request(APIClient::API_ENDPOINT . HLR::HLR_ENDPOINT . $mobile, HLR::HLR_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->payload->error);
            throw new \Exception($apiError->print());
            return false;
        }

        return array($executedRequest->response->body->payload);

    }

}