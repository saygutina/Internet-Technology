<?php

class SignUp {

    public static function register($login, $email, $password) {

        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = crypt($data['password']);
        R::store($user);

        return $user;
    }
}
