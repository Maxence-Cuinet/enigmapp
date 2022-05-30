<?php
require_once 'Controller/UserController.php';
require_once 'Controller/AuthController.php';

$request = $_SERVER['REQUEST_URI'];
$request = explode('?', $request)[0];
$request = explode('/', substr($request, 1));

switch ($request[0]) {
    case '':
        echo 'Hello World ! :)';
        break;
    case 'register':
        switch ($request[1] ?? '') {
            case 'submit':
                AuthController::register();
        }
        AuthController::inscriptionView();
        break;
    case 'users':
        switch ($request[1] ?? '') {
            case 'delete':
                UserController::action('delete', ['id' => $request[2] ?? 0]);
        }
        UserController::index();
        break;
    default:
        http_response_code(404);
        break;
}
