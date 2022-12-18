<?php

namespace Web\Routes;

use Web\ServerHandlers\Router;

class HttpRoutes
{
    public static function start()
    {
        Router::get('/reload', 'ServerController@reload');
        Router::get('/status', 'ServerController@status');
    }
}
