<?php
session_start();

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/CourseController.php';

$request = $_SERVER['REQUEST_URI'];
$request = explode('?', $request)[0];
$request = explode('/', substr($request, 1));

switch ($request[0]) {
    case '':
    case 'home':
        HomeController::index();
        break;
    case 'register':
        switch ($request[1] ?? '') {
            case 'submit':
                AuthController::register();
        }
        AuthController::inscriptionView();
        break;
    case 'connection':
        switch ($request[1] ?? '') {
            case 'login':
                AuthController::login();
        }
        AuthController::connectionView();
        break;
    case 'logout':
        AuthController::logout();
        break;
    case 'forget-password':
        switch ($request[1] ?? '') {
            case 'send-mail':
                AuthController::sendResetPasswordLink();
        }
        AuthController::forgetPasswordView();
        break;
    case 'change-password':
        switch ($request[1] ?? '') {
            case 'update':
                UserController::changePassword();
        }
        UserController::changePasswordView();
        break;
    case 'account':
        UserController::index();
        break;
    case 'delete':
        UserController::delete();
        break;
    case 'course':
        switch ($request[1] ?? '') {
            case 'create':
                switch ($request[2] ?? '') {
                    case 'submit':
                        CourseController::addCourse();
                }
                CourseController::addCourseView();
                break;
            case 'delete':
                CourseController::deleteCourse();
                break;
            case 'infos':
                CourseController::courseInfosView();
                break;
            case 'participate':
                switch ($request[2] ?? '') {
                    case 'abandon':
                        CourseController::participationAbandon();
                }
                CourseController::participateView();
                break;
        }
        break;
    case 'users':
        UserController::getAllUsers();
        break;
    case 'step':
        CourseController::getOneStep($request[1] ?? null);
        break;
    default:
        http_response_code(404);
        break;
}
