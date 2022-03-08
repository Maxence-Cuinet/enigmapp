<?php

class User
{
    private $id;
    private $login;
    private $password;
    private $mail;

    public function __construct($login, $password, $mail){
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        return $this->login = $login;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        return $this->password = $password;
    }

    public function getMail(){
        return $this->mail;
    }

    public function setMail($mail){
        return $this->mail = $mail;
    }

    
}