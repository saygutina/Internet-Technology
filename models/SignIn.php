<?php 

 Class SignIn {

    public static function get_auth() {
        if (isset($_POST['loginAuth']) && isset($_POST['passwordAuth'])) {
            $login = $_POST['loginAuth'];
            $$password = $_POST['passwordAuth'];
         }
        
         $user = R::findOne('users', "login = ?", array($login));
         $password_auth = $user->password;

         if (hash_equals((string)$password_auth, (string)crypt($password, $password_auth))) {
             $_SESSION['login'] = $user->login;
             $_SESSION['email'] = $user->email;

             if ($user->isAdmin == 1) {
                echo "admin";
            }

            echo "auth";
            
         } else {
            echo "fail";
         }
    }

 }