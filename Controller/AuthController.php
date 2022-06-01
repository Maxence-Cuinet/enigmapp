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

    public static function forgetPasswordView()
    {
        require __DIR__ . '/../view/forgetPasswordView.php';
    }

    public static function register()
    {
        $rep = User::create($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
        if ($rep) {
            $_POST['login'] = $_POST['mail'];
            self::login();
        }
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
            $_SESSION['user']['is_admin'] = $user->isAdmin();
            header("Location: /");
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        $_SESSION['is_logged'] = false;
        header("Location: /");
    }

    public static function sendResetPasswordLink()
    {
//        $to = $_POST['mail'];
//        $subject = 'Réinitialisation du mot de passe';
//        $message = 'test de mail';
//        mail($to, $subject, $message);
//        $_POST['mail_send'] = true;

        $user = User::findByMail($_POST['mail']);
        if ($user) {
            //@todo faire fonctionner l'envoie de mail et envoyer ce lien là
            header("Location: /change-password?user_id={$user->getId()}&secret={$user->getPassword()}");
        }
    }

    public static function isLogged(): bool
    {
        return isset($_SESSION['is_logged']) && $_SESSION['is_logged'];
    }

    public static function redirectIfNotLogged()
    {
        if (!self::isLogged()) {
            header("Location: /");
        }
    }
}
