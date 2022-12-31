<?php

namespace Web\Services;

abstract class BaseService
{
    public function getPDOConn(): \PDO
    {
        $dbHost = env('DB_HOST');
        $dbName = env('DB_NAME');
        $dbUser = env('DB_USER');
        $dbPass = env('DB_PASS');

        return new \PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
    }
}
