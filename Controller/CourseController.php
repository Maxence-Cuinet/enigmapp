<?php
include_once('Model/Course.php');

class CourseController
{
    public static function addCourseView()
    {
        require __DIR__ . '/../view/addCourseView.php';
    }

    public static function deleteCourse()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        if(empty($id)){
            echo json_encode([
                'message' => "Erreur : impossible de trouver le jeu de piste."
            ], JSON_UNESCAPED_UNICODE); //-> Pour éviter des erreurs d'encodage avec les accents
        }else{
            try{
                Course::delete((int)$id);
                echo json_encode([
                    'message' => "Succès : le jeu de piste a été supprimé"
                ], JSON_UNESCAPED_UNICODE);
            }catch(PDOException $e){
                echo json_encode([
                    'message' => "Erreur :".$e->getMessage()
                ], JSON_UNESCAPED_UNICODE);
            }
        }
        die;
    }
}
