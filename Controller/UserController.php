<?php
include_once('Model/User.php');

class UserController
{
    public static function index()
    {
        require __DIR__ . '/../view/accountView.php';
    }

    public static function changePasswordView()
    {
        require __DIR__ . '/../view/changePasswordView.php';
    }

    public static function changePassword()
    {
        if (AuthController::isLogged()) {
            $_POST['userId'] = $_SESSION['user']['id'];
            $_POST['secret'] = hash('sha256', $_POST['actualPassword']);
        }

        $user = User::findById($_POST['userId']);
        if ($_POST['secret'] === $user->getPassword()) {
            User::updatePassword($_POST['userId'], hash('sha256', $_POST['password']));
            AuthController::logout();
            header("Location: /connection");
        }
    }
}
