<?php

class Course
{
    private int $id;
    private string $name;
    private ?string $url_img;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function __construct(int $id, string $name, ?string $url_img, DateTime $created_at, DateTime $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_img = $url_img;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getUrlImg(): ?string
    {
        return $this->url_img;
    }

    public function setUrlImg(?string $url_img)
    {
        $this->url_img = $url_img;
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

    public static function findById(int $id): Course
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM course WHERE id = :id');
        $req->execute(['id' => $id]);

        $course = $req->fetch();
        return new course($course['id'], $course['name'], $course['url_img'], $course['created_at'], $course['updated_at']);
    }

    public static function findAll(int $page, int $nb): array
    {
        $pdo = Connexion::connect();

        $req = $pdo->prepare('SELECT * FROM course LIMIT :deb, :nb');
        $deb = $nb*($page-1);
        $req->bindParam("deb", $deb, PDO::PARAM_INT);
        $req->bindParam("nb", $nb, PDO::PARAM_INT);
        $req->execute();
        $courses = [];
        while ($course = $req->fetch())
        {
            $created_at = new DateTime($course['created_at']);
            $updated_at = new DateTime($course['updated_at']);
            $courses[] = new Course($course['id'], $course['name'], $course['url_img'], $created_at, $updated_at);
        }
        return $courses;
    }

    public static function create(string $name, ?string $url_img, ?string $description): bool
    {
        $date = new DateTime();
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO course (name, url_img, description, created_at, updated_at) VALUES (:name, :url_img, :description, :created_at, :updated_at)');
        return $req->execute([
            'name' => $name,
            'url_img' => $url_img,
            'description' => $description,
            'created_at' => $date->format("Y-m-d H:i:s"),
            'updated_at' => $date->format("Y-m-d H:i:s")
        ]);
    }

    public static function update(int $id, string $name, ?string $url_img, ?string $description): bool
    {
        $date = new DateTime();
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE course SET name = :name, url_img = :url_img, description = :description, updated_at = :updated_at WHERE id = :id');
        return $req->execute([
            'name' => $name,
            'url_img' => $url_img,
            'description' => $description,
            'updated_at' => $date->format("Y-m-d H:i:s"),
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM course WHERE id = :id');
        return $req->execute(['id' => $id]);
    }

    public static function count()
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT count(*) as count FROM course');
        $req->execute();
        $result = $req->fetch();
        return $result['count'];
    }
}