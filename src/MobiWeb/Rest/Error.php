<?php

namespace MobiWeb\Rest;

class Error {

    protected $errors;
    protected $status_code;
    protected $status_message;


    public function __construct(string $status_code = null, string $status_message = null, array $errors = null){

        if (!$status_code || !$status_message || !$errors) {
            throw new \Exception("Status Code, Status Message and Errors are required to create an Error");
        }

        $this->status_code = $status_code;
        $this->status_message = $status_message;
        $this->errors = $errors;
        
    }

    public function print(){

        echo "Error - HTTP: " . $this->status_code . " " . $this->status_message . " - API Error: " . print_r($this->errors, 1);
        return true;
    }

}