<?php

namespace App\models;

class User extends BaseModel
{
    public static function checkAuth()
    {
        return isset($_SESSION['user']);
    }

    public function login($login, $pass)
    {
        $user = $this->db->execute("SELECT * FROM users WHERE login=? LIMIT 1", [$login]);
        $user = reset($user);
        if(!empty($user) && password_verify($pass, $user->password)) {
            $_SESSION['user'] = $user->login;
            return true;
        }
        return false;
    }

    public function getUser($login)
    {

    }
}