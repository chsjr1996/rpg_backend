<?php

namespace Web\Servers;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

class SwooleHttpServer extends BaseSwooleServer
{
    public function start(): void
    {
        if (!$this->isHttpEnabled()) {
            echo "Swoole Http is not enabled, aborting...";
            return;
        }

        $httpServer = new Server($this->getHttpHost(), $this->getHttpPort());

        $httpServer->on("start", function (Server $httpServer) {
            echo "Swoole HTTP server is started at http://{$httpServer->host}:{$httpServer->port}\n";
        });

        $httpServer->on("request", function (Request $request, Response $response) use ($httpServer) {
            $requestUri = data_get($request->server, '[request_uri]');

            if ($requestUri === '/reload' && (bool) env('SWOOLE_HTTP_CAN_RELOAD', false)) {
                $httpServer->reload();

                $html = file_get_contents(__DIR__ . '/../Views/reload.html');
                $response->header("Content-Type", "text/html");
                $response->end($html);
            }

            $response->header("Content-Type", "application/json");
            $response->end(json_encode([
                'request_uri' => $requestUri,
                'server' => $request->server,
                'can_restart' => (bool) env('SWOOLE_HTTP_CAN_RELOAD', false),
            ]));
        });

        $httpServer->start();
    }
}
