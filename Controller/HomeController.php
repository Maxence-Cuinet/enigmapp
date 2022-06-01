<?php
include_once('Model/User.php');

class HomeController
{
    public static function index()
    {
        require __DIR__ . '/../view/homeView.php';
    }
}
