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
        if ($user && $_POST['secret'] === $user->getPassword()) {
            $user->updatePassword(hash('sha256', $_POST['password']));
            AuthController::isLogged() ? header("Location: /account") : header("Location: /connection");
        } else {
            unset($_POST);
            $_POST['errors'][] = "Le mot de passe actuel est incorrect.";
        }
    }
}
