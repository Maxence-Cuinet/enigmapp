<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public static function index()
    {
        require __DIR__ . '/../public/views/accountView.php';
    }

    public static function changePasswordView()
    {
        require __DIR__ . '/../public/views/changePasswordView.php';
    }

    public static function changePassword()
    {
        if (AuthController::isLogged()) {
            $_POST['userId'] = $_SESSION['user']['id'];

            $user = User::findById($_POST['userId']);
            if ($user && hash('sha256', $_POST['actualPassword']) === $user->getPassword()) {
                $user->updatePassword(hash('sha256', $_POST['password']));
                header("Location: /account");
            } else {
                unset($_POST);
                $_POST['errors'][] = "Le mot de passe actuel est incorrect.";
            }
        } else {
            $user = User::findById($_POST['userId']);
            if ($user && $_POST['secretKey'] === $user->getSecretKey()) {
                $user->updatePassword(hash('sha256', $_POST['password']));
                header("Location: /connection");
            } else {
                unset($_POST);
                $_POST['errors'][] = "Utilisateur introuvable.";
            }
        }
    }

    public static function delete()
    {
        $user = User::findById($_SESSION['user']['id']);
        if ($user) {
            $user->delete();
            AuthController::logout();
        }
    }

    public static function getAllUsers()
    {
        $users = User::findAll(true);
        header('HTTP/1.1 200 Ok');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users, JSON_PRETTY_PRINT);
    }
}
