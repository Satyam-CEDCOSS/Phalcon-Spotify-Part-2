<?php

namespace App\Handler;

session_start();
class Recommend
{
    public function api()
    {
        $token = $_SESSION['token'];
        $artistid = $_SESSION['seed_artists'];
        $url = "https://api.spotify.com/v1/recommendations?limit=8&seed_artists=$artistid";
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
