<?php

namespace App\Gateways;

use Illuminate\Support\Facades\Http;

Class DataGateway {

    public static function send($url, $method = "GET", $token = null, $data = []){
        if ($method == "POST")
            $result = Http::withHeaders([
                'X-API-TOKEN' => $token
            ])
                ->timeout(60)
                ->post($url,$data);
        else if($method == "GET")
            $result = Http::withHeaders([
                'X-API-TOKEN' => $token
            ])
                ->timeout(60)
                ->get($url);
        return json_decode($result->body(), true);
    }
}
