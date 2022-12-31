<?php

namespace Web\Servers;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Web\ServersHandlers\HttpRequestHandler;
use Web\ServiceContainer;

class SwooleHttpServer extends BaseSwooleServer
{
    public function start(): void
    {
        if (!$this->isHttpEnabled()) {
            console_out_warning('Swoole HTTP is not enabled, aborting...');
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
        console_out_success(sprintf('Swoole HTTP server is started at http://%s:%s', $httpServer->host, $httpServer->port));
    }

    private function handleRequest(Request $request, Response $response, Server $httpServer, ServiceContainer $container): void
    {
        $container->boot();

        // FIX: Override below container instances by request is a problem. Differents users requests can be mixed...
        $container->set(Request::class, $request);
        $container->set(Response::class, $response);
        $container->set(Server::class, $httpServer);

        HttpRequestHandler::onRequest($container->getContainer());
    }
}
