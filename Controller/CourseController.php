<?php
include_once('Model/Course.php');

class CourseController
{
    public static function addCourseView()
    {
        require __DIR__ . '/../view/addCourseView.php';
    }

    public static function addCourse()
    {
        if (!isset($_POST['name']) || !isset($_POST['image']) || !isset($_POST['description'])) {
            header("Location: /add-course");
        }

        if (Course::create($_POST['name'], $_POST['image'], $_POST['description'])) {
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
