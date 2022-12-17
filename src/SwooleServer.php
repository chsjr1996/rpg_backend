<?php

namespace App;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

class SwooleServer
{
    public static function start()
    {
        $server = new Server("0.0.0.0", 9501);

        $server->on("start", function (Server $server) {
            echo "Swoole http server is started at http://0.0.0.0:9501\n";
        });

        $server->on("request", function (Request $request, Response $response) {
            $response->header("Content-Type", "application/json");
            $response->end(json_encode(Game::run()));
        });

        $server->start();
    }
}
