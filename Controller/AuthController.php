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
        if (!isset($_POST['mail']) || !isset($_POST['username']) || !isset($_POST['password'])) {
            header("Location: /register");
        }

        $rep = User::create($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
        if ($rep) {
            $_POST['login'] = $_POST['mail'];
            self::login();
        } else {
            if (User::findByMail($_POST['mail'])) {
                $_POST['errors'][] = "Un utilisateur existe déjà avec cet email.";
            }
            if (User::findByUsername($_POST['username'])) {
                $_POST['errors'][] = "Le nom d'utilisateur est déjà pris.";
            }
            unset($_POST['password']);
            unset($_POST['confirmPassword']);
        }
    }

    public static function login()
    {
        if (!isset($_POST['login'])) {
            header("Location: /connection");
        }

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
        } else {
            $_POST['errors'][] = "L'email ou le mot de passe est incorrect.";
            unset($_POST['password']);
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
        if (!isset($_POST['mail'])) {
            header("Location: /forget-password");
        }

//        $to = $_POST['mail'];
//        $subject = 'Réinitialisation du mot de passe';
//        $message = 'test de mail';
//        mail($to, $subject, $message);
//        $_POST['mail_send'] = true;

        $user = User::findByMail($_POST['mail']);
        if ($user) {
            //@todo faire fonctionner l'envoie de mail et envoyer ce lien là
            header("Location: /change-password?user_id={$user->getId()}&secret={$user->getPassword()}");
        } else {
            $_POST['errors'][] = "Aucun utilisateur avec cet email n'a été trouvé.";
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
