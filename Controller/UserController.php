<?php
include_once('Model/User.php');

class UserController
{
    public static function action($params) {
        switch ($params['action']) {
            case 'delete':
                User::delete($params['id']);
        }
    }
}
