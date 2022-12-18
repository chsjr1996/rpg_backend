<?php

namespace Web\Controllers\Http;

use Swoole\Http\Response;

class BaseContoller
{
    protected function getViewPath(string $viewName): string
    {
        $viewsPath = __DIR__ . '/../../Views/';

        return $viewsPath . $viewName;
    }

    protected function jsonResponse(Response $response, $data, $status = 200)
    {
        $response->header('Content-Type', 'application/json');
        $response->status($status);
        $response->end(json_encode($data));
    }

    protected function viewResponse(Response $response, $html, $status = 200)
    {
        $response->header('Content-Type', 'text/html');
        $response->status($status);
        $response->end($html);
    }
}
