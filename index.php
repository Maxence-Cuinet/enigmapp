<?php
session_start();

require_once 'Controller/AuthController.php';
require_once 'Controller/HomeController.php';

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
                AuthController::changePassword();
        }
        AuthController::changePasswordView();
        break;
    default:
        http_response_code(404);
        break;
}
