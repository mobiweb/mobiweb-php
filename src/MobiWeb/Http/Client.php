<?php

namespace MobiWeb\Http;

class Client {

    const GET = "GET";
    const POST = "POST";
    const HTTP_OK = "200";
    const HTTP_CREATED = "201";

    protected $options = [
        CURLOPT_HEADER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HTTPHEADER => array("cache-control: no-cache", "content-type: application/json")
    ];


    public function __construct(){

    }

    public function request(string $url = null, string $method = null, array $headers = array(), $data = null): object{

        if(!$url){
            throw new \InvalidArgumentException("Invalid URL: ". $url);
        }
        if(!$method){
            throw new \InvalidArgumentException("Invalid Method: ". $method);
        }

        switch (strtoupper(trim($method))) {
            case Client::GET:
                $options[CURLOPT_HTTPGET] = true;
                break;
            case Client::POST:
                $options[CURLOPT_POST] = true;
                if($data) $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            default:
                throw new \Exception("Unsupported HTTP Method: ". $method);
        }

        $options[CURLOPT_URL] = $url;

        $request_options=$this->options+$options;

        foreach ($headers as $key => $value) {
            $request_options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        //make request;

        if (!$curl = curl_init()) {
            throw new \Exception("Unable to initialize request");
        }

        if (!curl_setopt_array($curl, $request_options)) {
            throw new \Exception(\curl_error($curl));
        }

        if (!$response = curl_exec($curl)) {
            throw new \Exception(\curl_error($curl));
        }

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        $headers = Client::getResponseHeaders($response, $headerSize);
        $body = Client::getResponseBody($response, $headerSize);

        $body = json_decode($body);

        curl_close($curl);

        $obj = new \stdClass();
        $obj->request = $request_options;
        $obj->response = new \stdClass();
        $obj->response->headers = $headers;
        $obj->response->body = $body;

        return $obj;


    }

    protected static function getResponseHeaders(string $response = null, string $headerSize = null): array{

        if(!$response){
            throw new \InvalidArgumentException("Invalid response");
        }

        if(!$headerSize){
            throw new \InvalidArgumentException("Invalid response headers");
        }

        $header = substr($response, 0, $headerSize);

        $headers = array();

        $headerText = substr($header, 0, strpos($header, "\r\n\r\n"));

        foreach (explode("\r\n", $headerText) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list ($key, $value) = explode(': ', $line);
    
                $headers[$key] = $value;
            }
        }

        return $headers;

    }

    protected static function getResponseBody(string $response = null, string $headerSize = null): string{

        if(!$response){
            throw new \Exception("Invalid response");
        }

        if(!$headerSize){
            throw new \Exception("Invalid response headers");
        }

        return substr($response, $headerSize);

    }

}