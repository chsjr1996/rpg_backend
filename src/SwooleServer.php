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

        $server->on("request", function (Request $request, Response $response) use ($server) {
            $requestUri = data_get($request->server, '[request_uri]');
            if ($requestUri === '/reload') {
                $server->reload();

                $html = file_get_contents(__DIR__ . '/Html/reload.html');
                $response->header("Content-Type", "text/html");
                $response->end($html);
            }

            $response->header("Content-Type", "application/json");
            $response->end(json_encode([
                'game' => Game::run(),
                'request_uri' => $requestUri,
                'server' => $request->server,
            ]));
        });

        $server->start();
    }
}
