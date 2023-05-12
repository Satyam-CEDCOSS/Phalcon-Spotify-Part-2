<?php

namespace App\Handler;

session_start();
class UserDetail
{
    public function api()
    {
        $token = $_SESSION['token'];
        // $token="BQDYbU5bvGu9T5qq4l08uewQbrHa8-PxGyH0GljRf1MBolBe0FchajxPIh3ObfcYWEj07OLcpWEihl4YUxmX-qMccY3NtsO2gIHs7PY6IX-vS8roawop4U2Vry57xgmJvdPnpZtQqndb-6MuCGkVnEDv99hO1TMxk7CdbZbJsgjBdWVf0M7_miAAea9Q7r6lf2VDTO1xwXOOdkSMii7j";
        print_r($token);die;
        $url = "https://api.spotify.com/v1/me";
        $header = [
            "Authorization: Bearer $token"
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
