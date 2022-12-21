<?php

namespace Web\Servers;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Web\ServiceContainer;
use Web\Services\Handlers\HttpRequestHandler;

class SwooleHttpServer extends BaseSwooleServer
{
    public function start(): void
    {
        if (!$this->isHttpEnabled()) {
            echo "Swoole Http is not enabled, aborting...", PHP_EOL;
            return;
        }

        $container = new ServiceContainer();
        $httpServer = new Server($this->getHttpHost(), $this->getHttpPort());
        $httpServer->on('start', fn (Server $httpServer) => $this->logStart($httpServer));
        $httpServer->on('request', fn (Request $req, Response $res) => $this->handleRequest($req, $res, $httpServer, $container));
        $httpServer->start();
    }

    private function logStart(Server $httpServer): void
    {
        echo "Swoole HTTP server is started at http://{$httpServer->host}:{$httpServer->port}", PHP_EOL;
    }

    private function handleRequest(Request $request, Response $response, Server $httpServer, ServiceContainer $container): void
    {
        $container->boot();
        $container->set(Request::class, $request);
        $container->set(Response::class, $response);
        $container->set(Server::class, $httpServer);

        HttpRequestHandler::init($container->getContainer());
    }
}
