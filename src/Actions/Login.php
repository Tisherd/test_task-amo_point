<?php

namespace Src\Actions;

use Src\Database\Users;

class Login
{
    public static function exec()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $users = new Users();

        $findUser = $users->selectUserByLoginAndPass($post['login'], $post['password']);

        if (!empty($findUser)) {
            $_SESSION['auth'] = true;
            return ['auth_status' => 1];
        } else {
            return ['auth_status' => 0];
        }
    }
}