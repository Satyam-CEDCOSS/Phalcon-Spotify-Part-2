<?php

namespace App\Handler;

session_start();
class GetId
{
    public function api($search, $type)
    {
        $token = $_SESSION['token'];
        $url = "https://api.spotify.com/v1/search?q=$search&type=$type";
        $header = [
            "Authorization: Bearer  $token"
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
}
