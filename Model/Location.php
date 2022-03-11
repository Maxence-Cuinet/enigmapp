<?php
include_once('Model/Connexion.php');

class Location{
    private int $id;
    private string $name;
    private string $description;
    private string $longitude;
    private string $latitude;
    private string $img;

    public function __construct(int $id, string $name, string $longitude, string $latitude, string $description = "", string $img = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->img = $img;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getLongitude(): string
    {
        return $this->longitude;
    }
    public function getLatitude(): string
    {
        return $this->latitude;
    }
    public function getImg(): string
    {
        return $this->img;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setDescription(string $description)
    {
        $this->description0 = $description;
    }
    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
    }
    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
    }
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM location WHERE id = :id');
        $req->execute(['id' => $id]);

        $location = $req->fetch();
        return new Location($location['id'], $location['name'], $location['longitude'], $location['latitude'], $location['description'], $location['img']);
    }

    public static function findAll() {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM location');
        $req->execute();

        $locations = [];
        while ($location = $req->fetch())
        {
            $locations[] = new Location($location['id'], $location['name'], $location['longitude'], $location['latitude'], $location['description'], $location['img']);
        }
        return $locations;
    }

    public static function create(int $id, string $name, string $longitude, string $latitude, string $description = "", string $img = null)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO location (name, longitude, latitude, description, img) VALUES (:name, :longitude, :latitude, :description, :img)');
        $req->execute([
            'name' => $name,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'description' => $description,
            'img' => $img
        ]);
    }

    public static function update(int $id, string $name, string $longitude, string $latitude, string $description = "", string $img = null)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE location SET name = :name, longitude = :longitude, latitude = :latitude, description = :description, img = :img WHERE id = :id');
        $req->execute([
            'name' => $name,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'description' => $description,
            'img' => $img,
            'id' => $id
        ]);
    }

    public static function delete(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM location WHERE id = :id');
        $req->execute(['id' => $id]);
    }
}