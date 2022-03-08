<?php

class AuthControler
{
    public function login(string $login, string $password)
    {
        // @todo connexion
        $_SESSION["is_logged"] = true;
    }
}