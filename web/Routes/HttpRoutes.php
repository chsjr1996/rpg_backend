<?php

namespace Web\Routes;

use Web\Services\Handlers\HttpRequestHandler as Route;

class HttpRoutes
{
    public static function start()
    {
        Route::get('/server/reload', 'ServerController@reload');
        Route::get('/server/status', 'ServerController@status');

        Route::get('/game/chars', 'GameController@chars');
        Route::get('/game/statuses', 'GameController@statuses');
        Route::get('/game/add-char-status', 'GameController@addCharStatus');
    }
}
