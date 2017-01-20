<?php

/**
 * контроллер для работы с пользователями
 */
class UserController
{
    public function login(){
        if(isset($_POST['login'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            User::checkUserData($login, $password);            
        }
        header('Location: /');
        return true;
    }

    public function logout(){
        unset($_SESSION['user']);
        header('Location: /');
    }
}