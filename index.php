<?php

use App\SwooleHttp;
use App\SwooleSocket;
use App\Utils\DotenvLoader;

require_once __DIR__ . '/vendor/autoload.php';

try {
    /**
     * Global utils
     */
    DotenvLoader::load();
    
    /**
     * Create a new game Http/Socket servers (if enabled, not both at same time)
     */
    SwooleSocket::start();
    SwooleHttp::start();
} catch (\Throwable $e) {
    echo sprintf("Error on startup app: %s", $e->getMessage());
}