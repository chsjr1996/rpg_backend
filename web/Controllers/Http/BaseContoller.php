<?php

namespace Web\Controllers\Http;

use DI\Container;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

class BaseContoller
{
    protected Request $request;
    protected Response $response;
    protected Server $server;

    public function __construct(protected Container $container)
    {
        $this->request = $container->get(Request::class);
        $this->response = $container->get(Response::class);
        $this->server = $container->get(Server::class);
    }

    protected function getViewPath(string $viewName): string
    {
        $viewsPath = __DIR__ . '/../../Views/';

        return $viewsPath . $viewName;
    }

    protected function jsonResponse($data, $status = 200)
    {
        $this->response->header('Content-Type', 'application/json');
        $this->response->status($status);
        $this->response->end(json_encode($data));
    }

    protected function htmlResponse($html, $status = 200)
    {
        $this->response->header('Content-Type', 'text/html');
        $this->response->status($status);
        $this->response->end($html);
    }
}
