<?php

namespace App;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

class SwooleServer
{
    public static function start()
    {
        $server = new Server(env('SWOOLE_HOST', '0.0.0.0'), env('SWOOLE_PORT', 9501));

        $server->on("start", function (Server $server) {
            echo "Swoole http server is started at http://{$server->host}:{$server->port}\n";
        });

        $server->on("request", function (Request $request, Response $response) use ($server) {
            $requestUri = data_get($request->server, '[request_uri]');

            if ($requestUri === '/reload' && (bool) env('SWOOLE_CAN_RELOAD', false)) {
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
                'can_restart' => (bool) env('SWOOLE_CAN_RELOAD', false),
            ]));
        });

        $server->start();
    }
}
