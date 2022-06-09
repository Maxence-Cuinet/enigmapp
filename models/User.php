<?php
require_once __DIR__ . '/Connexion.php';

class User
{
    private int $id;
    private string $mail;
    private string $username;
    private string $password;
    private bool $is_admin;
    private ?string $secret_key;
    private ?DateTime $generate_key_date;

    public function __construct(int $id, string $mail, string $username, string $password, bool $is_admin, ?string $secret_key, ?DateTime $generate_key_date)
    {
        $this->id = $id;
        $this->password = $password;
        $this->username = $username;
        $this->mail = $mail;
        $this->is_admin = $is_admin;
        $this->secret_key = $secret_key;
        $this->generate_key_date = $generate_key_date;
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
        $this->mail = $mail;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function getSecretKey(): string
    {
        return $this->secret_key;
    }

    public function setSecretKey(string $secret_key)
    {
        $this->secret_key = $secret_key;
    }

    public function getGenerateKeyDate(): DateTime
    {
        return $this->generate_key_date;
    }

    public function setGenerateKeyDate(DateTime $generate_key_date)
    {
        $this->generate_key_date = $generate_key_date;
    }

    /**
     * @param int $id
     * @return User|bool
     */
    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $req->execute(['id' => $id]);

        $user = $req->fetch();
        if ($user) {
            $generate_key_date = new DateTime($user['generate_key_date']) ;
            return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin'], $user['secret_key'], $generate_key_date);
        }
        return false;
    }

    /**
     * @param string $username
     * @return User|bool
     */
    public static function findByUsername(string $username)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE username = :username');
        $req->execute(['username' => $username]);

        $user = $req->fetch();
        if ($user) {
            $generate_key_date = new DateTime($user['generate_key_date']) ;
            return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin'], $user['secret_key'], $generate_key_date);
        }
        return false;
    }

    /**
     * @param string $mail
     * @return User|bool
     */
    public static function findByMail(string $mail)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user WHERE mail = :mail');
        $req->execute(['mail' => $mail]);

        $user = $req->fetch();
        if ($user) {
            $generate_key_date = new DateTime($user['generate_key_date']) ;
            return new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin'], $user['secret_key'], $generate_key_date);
        }
        return false;
    }

    public static function findAll(): array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM user');
        $req->execute();

        $users = [];
        while ($user = $req->fetch())
        {
            $generate_key_date = new DateTime($user['generate_key_date']);
            $users[] = new User($user['id'], $user['mail'], $user['username'], $user['password'], $user['is_admin'], $user['secret_key'], $generate_key_date);
        }
        return $users;
    }

    public static function create(string $mail, string $username, string $password): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO user (mail, username, password) VALUES (:mail, :username, :password)');
        return $req->execute([
            'mail' => $mail,
            'username' => $username,
            'password' => $password
        ]);
    }

    public static function createAdmin(string $mail, string $username, string $password): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO user (mail, username, password, is_admin) VALUES (:mail, :username, :password, 1)');
        return $req->execute([
            'mail' => $mail,
            'username' => $username,
            'password' => $password
        ]);
    }

    public function update(string $mail, string $username, string $password)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE user SET mail = :mail, username = :username, password = :password WHERE id = :id');
        $req->execute([
            'mail' => $mail,
            'username' => $username,
            'password' => $password,
            'id' => $this->getId()
        ]);
    }

    public function updatePassword(string $password)
    {
        $this->update($this->getMail(), $this->getUsername(), $password);
    }

    public function generateSecretKey(): string
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Europe/Paris');
        $date->setTimezone($timezone);

        $secretKey = hash('sha256', rand());

        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE user SET secret_key = :secretKey, generate_key_date = :generateKeyDate WHERE id = :id');
        $req->execute([
            'secretKey' => $secretKey,
            'generateKeyDate' => $date->format("Y-m-d H:i:s"),
            'id' => $this->getId()
        ]);
        return $secretKey;
    }

    public function delete()
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM user WHERE id = :id');
        $req->execute(['id' => $this->getId()]);
    }
}
