<?php

class Course
{
    private int $id;
    private string $name;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function __construct(int $id, string $name, DateTime $created_at, DateTime $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        $this->updated_at = new DateTime();
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM course WHERE id = :id');
        $req->execute(['id' => $id]);

        $course = $req->fetch();
        return new course($course['id'], $course['name'], $course['created_at'], $course['updated_at']);
    }

    public static function findAll() {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM course');
        $req->execute();

        $courses = [];
        while ($course = $req->fetch())
        {
            $courses[] = new course($course['id'], $course['name'], $course['created_at'], $course['updated_at']);
        }
        return $courses;
    }

    public static function create(int $id, string $name, string $created_at, string $updated_at)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO course (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)');
        $req->execute([
            'name' => $name,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

    public static function update(int $id, string $name, string $created_at, string $updated_at)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE course SET name = :name, created_at = :created_at, updated_at = :updated_at');
        $req->execute([
            'name' => $name,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'id' => $id
        ]);
    }

    public static function delete(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM course WHERE id = :id');
        $req->execute(['id' => $id]);
    }
}