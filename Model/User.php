<?php
include_once('Model/Connexion.php');

class User
{
    private int $id;
    private string $mail;
    private string $username;
    private string $password;
    private bool $is_admin;

    public function __construct(int $id, string $mail, string $username, string $password, bool $is_admin)
    {
        $this->id = $id;
        $this->password = $password;
        $this->username = $username;
        $this->mail = $mail;
        $this->is_admin = $is_admin;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        return $this->mail = $mail;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        return $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        return $this->password = $password;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $req->execute(['id' => $id]);

        $user = $req->fetch();
        return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin']);
    }

    public static function findByUsername(string $username)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE username = :username');
        $req->execute(['username' => $username]);

        $user = $req->fetch();
        return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin']);
    }

    public static function findByMail(string $mail)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE mail = :mail');
        $req->execute(['mail' => $mail]);

        $user = $req->fetch();
        return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin']);
    }

    public static function findAll() {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user');
        $req->execute();

        $users = [];
        while ($user = $req->fetch())
        {
            $users[] = new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin']);
        }
        return $users;
    }

    public static function create(string $mail, string $username, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO user (mail, username, password) VALUES (:mail, :username, :password)');
        $req->execute([
            'mail' => $mail,
            'username' => $username,
            'password' => $password
        ]);
    }

    public static function createAdmin(string $mail, string $username, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO user (mail, username, password, is_admin) VALUES (:mail, :username, :password, 1)');
        $req->execute([
            'mail' => $mail,
            'username' => $username,
            'password' => $password
        ]);
    }

    public static function update(int $id, string $mail, string $username, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE user SET mail = :mail, username = :username, password = :password WHERE id = :id');
        $req->execute([
            'mail' => $mail,
            'username' => $username,
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
