<?php

namespace App\Utils;

use Dotenv\Dotenv;

class DotenvLoader
{
    public static function load()
    {
        (Dotenv::createImmutable(__DIR__ . '/../../'))->load();
    }
}
