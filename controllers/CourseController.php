<?php
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Step.php';
require_once __DIR__ . '/../models/Answer.php';

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
            $course = Course::update($_POST['courseId'], $_POST['name'], $_POST['image'], $_POST['description']);
        } else {
            $course = Course::create($_POST['name'], $_POST['image'], $_POST['description']);
            foreach($_POST['step'] as $json){
                $step_array = json_decode($json, true);
                $step = Step::create($step_array['name'], $step_array['url_img'], $step_array['description'], $step_array['question'], 0, $course->getId());
                $answer1 = Answer::create($step->getId(), $step_array['answer1']);
                Step::update($step->getId(), $step->getName(), $step->getUrlImg(), $step->getDescription(), $step->getQuestion(), $answer1->getId(), $course->getId());
                $answer2 = Answer::create($step->getId(), $step_array['answer2']);
                $answer3 = Answer::create($step->getId(), $step_array['answer3']);
            }
        }

        if ($course) {
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
