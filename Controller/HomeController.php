<?php
include_once('Model/User.php');
include_once('Model/Course.php');

class HomeController
{
    public static function index()
    {
        $page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
        $count = Course::count();
        $max = round($count/8);
        if($page > $max){
            header("Location: /home?page=".$max);
        }
        if($page < 1){
            header("Location: /home?page=1");
        }
        $_POST['page'] = $page;
        $_POST['max'] = $max;
        $courses = Course::findAll($page, 8);
        $_POST['courses'] = $courses;
        require __DIR__ . '/../view/homeView.php';
    }
}
