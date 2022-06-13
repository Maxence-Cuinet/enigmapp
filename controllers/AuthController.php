<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public static function inscriptionView()
    {
        require __DIR__ . '/../public/views/inscriptionView.php';
    }

    public static function connectionView()
    {
        require __DIR__ . '/../public/views/connectionView.php';
    }

    public static function forgetPasswordView()
    {
        require __DIR__ . '/../public/views/forgetPasswordView.php';
    }

    public static function register()
    {
        if (!isset($_POST['mail']) || !isset($_POST['username']) || !isset($_POST['password'])) {
            header("Location: /register");
        }

        if (isset($_POST['isAdmin'])) {
            $rep = User::createAdmin($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
        } else {
            $rep = User::create($_POST['mail'], $_POST['username'], hash('sha256', $_POST['password']));
        }

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
            if (isset($_GET['redirect'])) {
                header("Location: /course/infos?courseId={$_GET['redirect']}");
            } else {
                header("Location: /");
            }
        } else {
            $_POST['errors'][] = "L'email ou le mot de passe est incorrect.";
            unset($_POST['password']);
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        $_SESSION['is_logged'] = false;
        $_SESSION['homeView'] = 'default';
        header("Location: /");
    }

    public static function sendResetPasswordLink()
    {
        if (!isset($_POST['mail'])) {
            header("Location: /forget-password");
        }

        $user = User::findByMail($_POST['mail']);
        if ($user) {
            header("Location: /change-password?user_id={$user->getId()}&secret_key={$user->generateSecretKey()}");

//            $to = $_POST['mail'];
//            $subject = 'Réinitialisation du mot de passe';
//            $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe :\n http://enigmapp.alwaysdata.net/change-password?user_id={$user->getId()}&secret_key={$user->generateSecretKey()}";
//            mail($to, $subject, $message);
//            $_POST['success'][] = "Email envoyé avec succés !";
        } else {
            $_POST['errors'][] = "Aucun utilisateur avec cet email n'a été trouvé.";
        }
    }

    public static function isLogged(bool $asAdmin = false): bool
    {
        return isset($_SESSION['is_logged']) && $_SESSION['is_logged'] && (!$asAdmin || $_SESSION['user']['is_admin']);
    }

    public static function redirectIfNotLogged(bool $asAdmin = false)
    {
        if (!self::isLogged($asAdmin)) {
            header("Location: /");
        }
    }
}
