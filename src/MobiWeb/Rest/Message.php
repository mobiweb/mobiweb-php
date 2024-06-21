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
        }

        $endpoint = $auth->getEndPoint();

        $http = new HttpClient();
        $headers = array();
        $headers["Authorization"] = "Bearer " . $access_token;
        $body = array();

        foreach($args as $key => $messageGroup){
            $obj = new \stdClass();
            $obj->to = $messageGroup["to"];
            $obj->from = $messageGroup["from"];
            $obj->message = $messageGroup["message"];
            if(isset($messageGroup["options"]["track_url"]))$obj->track_url = $messageGroup["options"]["track_url"];
            if(isset($messageGroup["options"]["receive_dlr"]))$obj->receive_dlr = $messageGroup["options"]["receive_dlr"];
            if(isset($messageGroup["options"]["message_type"]))$obj->message_type = $messageGroup["options"]["message_type"];
            if(isset($messageGroup["options"]["reference_code"]))$obj->reference_code = $messageGroup["options"]["reference_code"];
            if(isset($messageGroup["options"]["schedule_date"]))$obj->schedule_date = $messageGroup["options"]["schedule_date"];
            if(isset($messageGroup["options"]["expire_date"]))$obj->expire_date = $messageGroup["options"]["expire_date"];

            $body[] = $obj;
        }

        $executedRequest=$http->request($endpoint . Message::SEND_ENDPOINT, Message::SEND_METHOD, $headers, $body);

        $errors = array();
        $responseElements=$executedRequest->response->body->payload;
        foreach($responseElements as $responseElement){
            if($responseElement->status == "error"){
                $errors[] = $responseElement->error;
            }
        }

        if(count($errors) > 0){
            $apiError = new APIError($executedRequest->response->body->status_code, $executedRequest->response->body->status_message, $errors);
            $apiError->print();

        }

        return array($executedRequest->response->body->payload);

    }

}