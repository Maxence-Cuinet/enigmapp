<?php
class Location{
    private int $id;
    private string $name;
    private string $description;
    private string $longitude;
    private string $latitude;
    private string $img;

    public function __construct($name, $description = "", $longitude, $latitude, $img = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->img = $img;
    }

    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getLongitude(){
        return $this->longitude;
    }
    public function getLatitude(){
        return $this->latitude;
    }
    public function getImg(){
        return $this->img;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function setDescription($description){
        $this->description0 = $description;
    }
    public function setLongitude($longitude){
        $this->longitude = $longitude;
    }
    public function setLatitude($latitude){
        $this->latitude = $latitude;
    }
    public function setImg($img){
        $this->img = $img;
    }
}