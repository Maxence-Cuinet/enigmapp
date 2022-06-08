<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Course.php';

class HomeController
{
    public static function index()
    {
        if (isset($_GET['admin'])) {
            $_SESSION['homeView'] = 'admin';
        }
        if (isset($_GET['default']) || !isset($_SESSION['homeView'])) {
            $_SESSION['homeView'] = 'default';
        }

        $nbParPage = 8;
        if ($_SESSION['homeView'] === 'admin') {
            $nbParPage = 10;
        }

        $count = Course::count();
        $max = $count == 0 ? 1 : ceil($count / $nbParPage);

        $page = $_GET['page'] ?? 1;
        if ($page > $max) {
            header("Location: /home?page=" . $max);
        } else if ($page < 1) {
            header("Location: /home?page=1");
        }

        $_POST['page'] = $page;
        $_POST['max'] = $max;
        $courses = Course::findAll($page, $nbParPage);
        $_POST['courses'] = $courses;

        if ($_SESSION['homeView'] === 'admin') {
            require __DIR__ . '/../public/views/adminView.php';
        } else {
            require __DIR__ . '/../public/views/homeView.php';
        }
    }
}
