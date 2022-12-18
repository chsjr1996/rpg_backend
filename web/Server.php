<?php

use Web\Servers\SwooleHttpServer;
use Web\Servers\SwooleSocketServer;

require __DIR__ . '/../vendor/autoload.php';

try {
    echo "Starting server...", PHP_EOL;
    echo "Loading envs", PHP_EOL;
    /**
     * Application bootstrap
     */
    load_envs();

    /**
     * Create a new game Http/Socket servers (if enabled, not both at same time)
     */
    (new SwooleSocketServer)->start();
    (new SwooleHttpServer)->start();
} catch (\Throwable $e) {
    echo sprintf("Error on startup app: %s", $e->getMessage());
}
