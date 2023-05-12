<?php

use Phalcon\Mvc\Controller;

session_start();
class SignupController extends Controller
{
    public function indexAction()
    {
        // Redirect To View
    }
    public function addAction()
    {
        $product = new \Users();
        $product->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'password',
            ]
        );
        $done = $product->save();
        if ($done) {
            $this->response->redirect('login');
        }
    }
}