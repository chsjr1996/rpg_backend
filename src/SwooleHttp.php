<?php

namespace App;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

class SwooleHttp
{
    public static function start(): void
    {
        if (!(bool) env('SWOOLE_HTTP_ENABLED', false)) {
            echo "Swoole Http is not enabled, aborting...";
            return;
        }

        $httpServer = new Server(env('SWOOLE_HTTP_HOST', '0.0.0.0'), env('SWOOLE_HTTP_PORT', 9501));

        $httpServer->on("start", function (Server $httpServer) {
            echo "Swoole HTTP server is started at http://{$httpServer->host}:{$httpServer->port}\n";
        });

        $httpServer->on("request", function (Request $request, Response $response) use ($httpServer) {
            $requestUri = data_get($request->server, '[request_uri]');

            if ($requestUri === '/reload' && (bool) env('SWOOLE_SERVER_CAN_RELOAD', false)) {
                $httpServer->reload();

                $html = file_get_contents(__DIR__ . '/Html/reload.html');
                $response->header("Content-Type", "text/html");
                $response->end($html);
            }

            $response->header("Content-Type", "application/json");
            $response->end(json_encode([
                'game' => Game::run(),
                'request_uri' => $requestUri,
                'server' => $request->server,
                'can_restart' => (bool) env('SWOOLE_SERVER_CAN_RELOAD', false),
            ]));
        });

        $httpServer->start();
    }
}
