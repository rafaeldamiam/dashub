<?php

require_once "model/user.model.php";

/** anon */
function index() {
    if (Services::postMethod()) {
        extract($_POST);
        $user = UserModel::takeUserByEmailPassword($email, $password);
        if (Access::accessLogin($user)) {
            Alert::showAlert("Welcome" . $login);
            View::redirectView("app/index");
        } else {
            Alert::showAlert("User or Password Invalid!");
        }
    }
    View::showView("login/index");
}

/** anon */
function logout() {
    Access::accessLogout();
    Alert::showAlert("Logout Sucessful!");
    View::redirectView("app/index");
}

?>