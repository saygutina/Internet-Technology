<?php

require_once "../../components/DB_Connect.php";

$data = $_POST;

if ($data['login'] == "" || $data['email'] == "" || $data['password'] == "") {
    $errors [] = "Заполните все данные, пожалуйста";
}

if (R::count('users', "username = ?", array($data['login'])) > 0) {
    $errors[] = "Пользователь с таким логином уже существует!";
}

if (R::count('users', "email = ?", array($data['email'])) > 0) {
    $errors[] = "Пользователь с таким email уже существует!";
}

if (empty($errors)) {

    $user = R::dispense('users');
    $user->login = $data['login'];
    $user->email = $data['email'];
    $user->password = crypt($data['password']);
    R::store($user);
    echo "ok";

} else {
    echo "<div style='color: red;'>" . array_shift($errors) . "</div><hr>";
}

