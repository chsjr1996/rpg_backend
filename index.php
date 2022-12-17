<?php

use App\SwooleServer;
use App\Utils\DotenvLoader;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Global utils
 */
DotenvLoader::load();

/**
 * Create a new game Server
 */
SwooleServer::start();