<?php

namespace MobiWeb\Rest;

use MobiWeb\Rest\Authentication as Auth;
use MobiWeb\Rest\Client as APIClient;
use MobiWeb\Http\Client as HttpClient;
use MobiWeb\Rest\Error as APIError;

class Message {

    const SEND_ENDPOINT = "/sms/mt/v2/send";
    const SEND_METHOD = "POST";


    public static function broadcast(Auth $auth = null, array $args): array{

        if (!$auth) {
            throw new \Exception("Cannot send message without authentication");
        }

        $access_token = $auth->getAccessToken();
        if(!$access_token){
            throw new \Exception("Cannot retrieve Access Token");
            return false;
        }

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $body = array();

        foreach($args as $key => $messageGroup){
            $obj = new \stdClass();
            $obj->to = $messageGroup["to"];
            $obj->from = $messageGroup["from"];
            $obj->message = $messageGroup["message"];
            if($messageGroup["options"]["track_url"])$obj->track_url = $messageGroup["options"]["track_url"];
            if($messageGroup["options"]["receive_dlr"])$obj->receive_dlr = $messageGroup["options"]["receive_dlr"];
            if($messageGroup["options"]["message_type"])$obj->message_type = $messageGroup["options"]["message_type"];
            if($messageGroup["options"]["reference_code"])$obj->reference_code = $messageGroup["options"]["reference_code"];
            if($messageGroup["options"]["schedule_date"])$obj->schedule_date = $messageGroup["options"]["schedule_date"];
            if($messageGroup["options"]["expire_date"])$obj->expire_date = $messageGroup["options"]["expire_date"];

            $body[] = $obj;
        }
        $executedRequest=$http->request(APIClient::API_ENDPOINT . Message::SEND_ENDPOINT, Message::SEND_METHOD, $headers, $body);

        if($executedRequest->response->body->status_code != HttpClient::HTTP_OK){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $executedRequest->response->body->errors);
            throw new \Exception($apiError->print());
            return false;
        }

        return array($executedRequest->response->body->payload);

    }

}