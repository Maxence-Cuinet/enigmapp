<?php
include_once('Model/Connexion.php');

class User
{
    private int $id;
    private string $login;
    private string $mail;
    private string $password;

    public function __construct(int $id, string $login, string $mail, string $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        return $this->login = $login;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        return $this->mail = $mail;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        return $this->password = $password;
    }

    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $req->execute(['id' => $id]);

        $user = $req->fetch();
        return new User($user['id'], $user['login'], $user['mail'], $user['password']);
    }

    public static function findByLogin(string $login)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE login = :login');
        $req->execute(['login' => $login]);

        $user = $req->fetch();
        return new User($user['id'], $user['login'], $user['mail'], $user['password']);
    }

    public static function findAll() {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user');
        $req->execute();

        $users = [];
        while ($user = $req->fetch())
        {
            $users[] = new User($user['id'], $user['login'], $user['mail'], $user['password']);
        }
        return $users;
    }

    public static function create(string $login, string $mail, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO user (login, mail, password) VALUES (:login, :mail, :password)');
        $req->execute([
            'login' => $login,
            'mail' => $mail,
            'password' => $password
        ]);
    }

    public static function update(int $id, string $login, string $mail, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE user SET login = :login, mail = :mail, password = :password WHERE id = :id');
        $req->execute([
            'login' => $login,
            'mail' => $mail,
            'password' => $password,
            'id' => $id
        ]);
    }

    public static function delete(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM user WHERE id = :id');
        $req->execute(['id' => $id]);
    }
}
