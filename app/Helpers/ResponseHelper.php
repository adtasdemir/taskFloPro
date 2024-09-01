<?php

namespace App\Helpers;

class ResponseHelper
{
    static function response(bool $success, ?string $message = "", $data = [], $extraData = []): array
    {
        $response['success'] = $success;
        if(!empty($message)){
            $response['message'] = $message;
        } 
        if(!empty($data)){
            $response['data'] = $data;
        } 
        if(!empty($extraData)){
            $response['extra_data'] = $extraData;
        } 
        return $response;
    }
}
