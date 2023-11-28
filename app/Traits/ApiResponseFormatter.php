<?php

namespace app\Traits;

trait ApiResponseFormatter{

    public function apiresponse($code = 200, $message = "success", $data = []){
        
        return json_encode([
            "code" => $code,
            "message"=> $message,
            "data"=> $data
        ]);
    }
}