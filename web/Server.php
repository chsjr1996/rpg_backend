<?php

use Web\Routes\HttpRoutes;
use Web\Servers\SwooleHttpServer;
use Web\Servers\SwooleSocketServer;

require __DIR__ . '/../vendor/autoload.php';

try {
    console_out_success('Starting server...');
    console_out_success('Loading envs');

    /**
     * Application bootstrap
     */
    load_envs();
    HttpRoutes::start();

    /**
     * Create a new game Http/Socket servers (if enabled, not both at same time)
     */
    (new SwooleSocketServer)->start();
    (new SwooleHttpServer)->start();
} catch (\Throwable $e) {
    console_out_error(sprintf("Error on startup app: %s", $e->getMessage()));
}
