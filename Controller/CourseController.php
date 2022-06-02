<?php

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

        Course::create($_POST['name'], $_POST['image'], $_POST['description']);
    }
}
