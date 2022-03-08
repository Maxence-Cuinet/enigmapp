<?php
class Location{
    private int $id;
    private string $name;
    private string $description;
    private string $longitude;
    private string $latitude;
    private string $img;

    public function __construct(string $name, string $longitude, string $latitude, string $description = "", string $img = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->img = $img;
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
}