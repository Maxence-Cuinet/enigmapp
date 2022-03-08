<?php

class User
{
    private int $id;
    private string $login;
    private string $password;
    private string $mail;

    public function __construct(string $login, string $password, string $mail)
    {
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        return $this->id = $id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        return $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        return $this->password = $password;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        return $this->mail = $mail;
    }
}