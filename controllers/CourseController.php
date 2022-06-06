<?php
require_once __DIR__ . '/../models/Course.php';

class CourseController
{
    public static function addCourseView()
    {
        require __DIR__ . '/../public/views/addCourseView.php';
    }

    public static function addCourse()
    {
        if (!isset($_POST['name']) || !isset($_POST['image']) || !isset($_POST['description'])) {
            header("Location: /add-course");
        }

        if ($_POST['courseId']) {
            $rep = Course::update($_POST['courseId'], $_POST['name'], $_POST['image'], $_POST['description']);
        } else {
            $rep = Course::create($_POST['name'], $_POST['image'], $_POST['description']);
        }

        if ($rep) {
            header("Location: /");
        }
    }

    public static function deleteCourse()
    {
        if (!AuthController::isLogged(true) || !isset($_REQUEST['id'])) {
            header("Location: /");
        }

        try {
            Course::delete((int) $_REQUEST['id']);
            echo json_encode([
                'message' => "Succès : le jeu de piste a été supprimé"
            ], JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            echo json_encode([
                'message' => "Erreur :" . $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
        die;
    }
}
