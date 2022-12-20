<?php

namespace Web\Routes;

use Web\ServerHandlers\Router;

class HttpRoutes
{
    public static function start()
    {
        Router::get('/server/reload', 'ServerController@reload');
        Router::get('/server/status', 'ServerController@status');

        Router::get('/game/chars', 'GameController@chars');
        Router::get('/game/statuses', 'GameController@statuses');
        Router::get('/game/add-char-status', 'GameController@addCharStatus');
    }
}
