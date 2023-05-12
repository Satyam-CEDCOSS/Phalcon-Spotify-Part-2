<?php

use Phalcon\Mvc\Controller;

session_start();
class AddController extends Controller
{
    public function indexAction()
    {
        $value = $_GET;
        // print_r($value);die;
        $data = $this->getData->api($value['type'], $value['id']);
        if ($value['type'] == 'albums') {
            $arr = [
                'uid' => $_SESSION['userid'],
                'name' => $data['name'],
                'artist' => $data['artists']['0']['name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'artists') {
            $_SESSION['seed_artists'] = $value['id'];
            $arr = [
                'uid' => $_SESSION['userid'],
                'name' => $data['type'],
                'artist' => $data['name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'playlists') {
            $arr = [
                'uid' => $_SESSION['userid'],
                'name' => $data['name'],
                'artist' => $data['owner']['display_name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'tracks') {
            $arr = [
                'uid' => $_SESSION['userid'],
                'name' => $data['album']['name'],
                'artist' => $data['artists']['0']['name'],
                'image' => $data['album']['images']['0']['url'],
                'type' => $value['type'],
            ];
        }

        $product = new \Datas();
        $product->assign(
            $arr,
            [
                'uid',
                'name',
                'artist',
                'image',
                'type',
            ]
        );
        $done = $product->save();
        if ($done) {
            $this->response->redirect('display');
        }
    }
}
