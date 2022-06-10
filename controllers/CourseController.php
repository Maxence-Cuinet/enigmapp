<?php
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Step.php';
require_once __DIR__ . '/../models/Answer.php';

class CourseController
{
    public static function courseInfosView()
    {
        require __DIR__ . '/../public/views/courseInfosView.php';
    }

    public static function addCourseView()
    {
        require __DIR__ . '/../public/views/addCourseView.php';
    }

    public static function addCourse()
    {
        if (!isset($_POST['name']) || !isset($_POST['image']) || !isset($_POST['description'])) {
            header("Location: /course/create");
        }

        if(!isset($_POST['step'])) {
            $_POST['errors'][] = "Le jeu de piste doit avoir au moins une étape";
            
        } else {
            if ($_POST['courseId']) {
                //On met à jour le jeu de piste
                $course = Course::update($_POST['courseId'], $_POST['name'], $_POST['image'], $_POST['description']);

                //On commence par supprimer toutes les réponses liés aux étapes
                $steps = Step::findAllByCourseId($course->getId());
                foreach($steps as $step){
                    Answer::deleteByStepId($step->getId());
                }

                //On supprime ensuite toutes les étapes
                Step::deleteAllByCourseId($course->getId());

                
            } else {
                //On enregistre le jeu de piste
                $course = Course::create($_POST['name'], $_POST['image'], $_POST['description']);
            }
            //On ajoute les étapes et les réponses passés par le formulaire
            foreach($_POST['step'] as $json){
                $step_array = json_decode($json, true);
                $step = Step::create($step_array['name'], $step_array['url_img'], $step_array['description'], $step_array['question'], 0, $course->getId(), $step_array['indice']);
                $answer1 = Answer::create($step->getId(), $step_array['answer1']);
                Step::update($step->getId(), $step->getName(), $step->getUrlImg(), $step->getDescription(), $step->getQuestion(), $answer1->getId(), $course->getId(), $step->getIndice());
                $answer2 = Answer::create($step->getId(), $step_array['answer2']);
                $answer3 = Answer::create($step->getId(), $step_array['answer3']);
            }
            if ($course) {
                header("Location: /");
            }

        }
        
    }

    public static function deleteCourse()
    {
        if (!AuthController::isLogged(true) || !isset($_REQUEST['id'])) {
            header("Location: /");
        }

        try {
            //On commence par supprimer les étapes et les réponses liés au jeu de piste
            $steps = Step::findAllByCourseId((int) $_REQUEST['id']);
            foreach($steps as $step){
                Answer::deleteByStepId($step->getId());
            }
            Step::deleteAllByCourseId((int) $_REQUEST['id']);

            //On supprime ensuite la course
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
