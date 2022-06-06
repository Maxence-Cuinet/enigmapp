<?php

class Connexion
{
    private static array $dbParams = [
        'host' => 'localhost',
        'dbName' => 'enigmapp',
        'user' => 'root',
        'password' => ''
    ];

    public static function connect()
    {
        $dbParams = self::$dbParams;
        return new PDO("mysql:host={$dbParams['host']};dbname={$dbParams['dbName']}",
            $dbParams['user'],
            $dbParams['password']
        );
    }
}
