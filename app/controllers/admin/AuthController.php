<?php

namespace App\controllers\admin;

use App\controllers\BaseController;
use App\models\User;

class AuthController extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        if(User::checkAuth() && $route['action'] != 'logout') {
            $this->redirect('/');
        }
    }

    public function loginAction()
    {

    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/');
    }

    public function authenticateAction()
    {
        if(empty($_POST)) return;

        $login = (!empty($_POST['login']) ? trim($_POST['login']) : NULL);
        $pass = (!empty($_POST['password']) ? trim($_POST['password']) : NULL);

        if($login && $pass) {
            $model = new User();
            if($user = $model->login($login, $pass)) {
                $_SESSION['user'] = $user->login;
                $_SESSION['success'] = "Вы авторизованы.";
                $this->redirect('/');
            }
        }
        $_SESSION['errors']['login'] = "Не верно введен login/password.";
        $this->redirect('/login');
    }
}