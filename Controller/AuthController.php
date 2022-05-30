<?php

class AuthController
{
    public static function inscriptionView()
    {
        require __DIR__ . '/../View/inscription.php';
    }

    public static function register()
    {
        User::create($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
    }

    public function login(string $login, string $password)
    {
        // @todo connexion
        $_SESSION["is_logged"] = true;
    }
}