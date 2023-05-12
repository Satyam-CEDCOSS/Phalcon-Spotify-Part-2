<?php

use Phalcon\Mvc\Controller;

session_start();
class IndexController extends Controller
{
    public function indexAction()
    {
        $this->response->redirect('login');
    }
    public function tokenAction()
    {
        $_SESSION['token'] = $this->apiUrl->api()->access_token;
        // print_r($this->userdetail->api());die;
        if (!isset($_SESSION['seed_artists'])) {
            $_SESSION['seed_artists'] = "4NHQUGzhtTLFvgF5SZesLK";
        }
        $data = $this->recommend->api();
        $this->view->recommend = '<h3>Recommendation</h3>';
        foreach ($data['tracks'] as $value) {
            $this->view->recommend .= ' <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                  <div class="card w-100 my-2 shadow-2-strong">
                    <img src=' . $value['album']['images']['0']['url'] .
                ' class="card-img-top" style="aspect-ratio: 1 / 1" />
                    <div class="card-body d-flex  flex-column">
                      <h5 class="card-title">' . $value['name'] . '</h5>
                      <p class="card-title">Artist: ' . $value['artists'][0]['name'] . '</p>
                      <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto ">
                      <a href="../add?id=' . $value['id'] .
                '&type=tracks" class="btn btn-primary shadow-0 me-1">Add </a>
                      </div>
                    </div>
                  </div>
                </div>';
        }
    }
}
