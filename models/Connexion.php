<?php

class Connexion
{
    private static array $dbParams = [
        'host' => 'mysql-enigmapp.alwaysdata.net',
        'dbName' => 'enigmapp_bdd',
        'user' => 'enigmapp_admin',
        'password' => '@dminEn1gm@pp'
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
