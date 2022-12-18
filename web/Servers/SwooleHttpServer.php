<?php

namespace Web\Servers;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Web\ServerHandlers\Router;

class SwooleHttpServer extends BaseSwooleServer
{
    public function start(): void
    {
        if (!$this->isHttpEnabled()) {
            echo "Swoole Http is not enabled, aborting...", PHP_EOL;
            return;
        }

        $httpServer = new Server($this->getHttpHost(), $this->getHttpPort());

        $httpServer->on("start", function (Server $httpServer) {
            echo "Swoole HTTP server is started at http://{$httpServer->host}:{$httpServer->port}", PHP_EOL;
        });

        $httpServer->on("request", function (Request $request, Response $response) use ($httpServer) {
            Router::get('/reload', 'ServerController@reload');
            Router::get('/status', 'ServerController@status');

            Router::handle($request, $response, $httpServer);
        });

        $httpServer->start();
    }
}
