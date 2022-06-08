<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Course.php';

class HomeController
{
    public static function index()
    {
        $count = Course::count();
        $max = $count == 0 ? 1 : ceil($count/8);

        $page = $_GET['page'] ?? 1;
        if ($page > $max) {
            header("Location: /home?page=" . $max);
        } else if ($page < 1) {
            header("Location: /home?page=1");
        }

        $_POST['page'] = $page;
        $_POST['max'] = $max;
        $courses = Course::findAll($page, 8);
        $_POST['courses'] = $courses;

        require __DIR__ . '/../public/views/homeView.php';
    }
}
