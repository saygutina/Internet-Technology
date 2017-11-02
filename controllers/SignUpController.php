<?php

include_once(ROOT."/models/SignUp.php");

class SignUpController {

    public function actionIndex() {

        echo "hello";
        /* require_once(ROOT."/views/signup/index.php"); */

    }

    public function actionRegister() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Router::ErrorPage405();
            return;
        }
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($login) && empty($email) && empty($password)) {

        }
    }

}