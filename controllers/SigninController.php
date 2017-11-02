<?php

include_once(ROOT."/models/SignIn.php");

class SigninController {

    public function actionIndex() {
        echo "SignIn";
        $auth = SignIn::get_auth();
        return true;
    }

}