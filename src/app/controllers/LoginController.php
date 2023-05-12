<?php

use Phalcon\Mvc\Controller;

session_start();
class LoginController extends Controller
{
    public function indexAction()
    {
        // Redirect To View
    }
    public function checkAction()
    {
        $sql = 'SELECT * FROM Users WHERE email = :email: AND password = :password:';
        $query = $this->modelsManager->createQuery($sql);
        $user = $query->execute(
            [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]
        );
        if (isset($user[0])) {
            $_SESSION['userid'] = $user[0]->uid;
            $clientID  = "806294fa00c04ae2900bd53d72410ba1";
            $this->response->redirect("https://accounts.spotify.com/authorize?response".
            "_type=code&client_id=$clientID&scope=playlist-read-private&code_challenge".
            "_method=S256&redirect_uri=http://localhost:8080/index/token");
        }
    }
}
