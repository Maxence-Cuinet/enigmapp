<?php
include_once('Model/User.php');

class UserController
{
    public static function index()
    {
        require __DIR__ . '/../view/userListView.php';
    }

    public static function action($action, $params) {
        switch ($action) {
            case 'delete':
                User::delete($params['id']);
        }
    }
}
