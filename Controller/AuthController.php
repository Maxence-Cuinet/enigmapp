<?php
include_once('Model/User.php');

class AuthController
{
    public static function inscriptionView()
    {
        require __DIR__ . '/../view/inscriptionView.php';
    }

    public static function connectionView()
    {
        require __DIR__ . '/../view/connectionView.php';
    }

    public static function register()
    {
        User::create($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
    }

    public static function login()
    {
        $user = User::findByMail($_POST['login']);
        if (!$user) {
            $user = User::findByUsername($_POST['login']);
        }

        if ($user && hash('sha256', $_POST['password']) === $user->getPassword()) {
            $_SESSION['is_logged'] = true;
            $_SESSION['user']['id'] = $user->getId();
            $_SESSION['user']['mail'] = $user->getMail();
            $_SESSION['user']['username'] = $user->getUsername();
        }
        header("Location: /");
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        $_SESSION['is_logged'] = false;
        header("Location: /");
    }
}
