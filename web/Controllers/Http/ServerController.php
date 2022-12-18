<?php

namespace Web\Controllers\Http;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Web\ServerHandlers\Router;

class ServerController extends BaseContoller
{
    public function reload(Request $request, Response $response, Server $server)
    {
        if (!(bool) env('SWOOLE_HTTP_CAN_RELOAD', false)) {
            $this->jsonResponse($response, ['message' => 'reload disabled...']);
        }

        if (!$server->reload()) {
            $this->jsonResponse($response, ['message' => 'error on reload...'], 500);
        }

        $html = file_get_contents($this->getViewPath('reload.html'));
        $this->viewResponse($response, $html);
    }

    public function status(Request $request, Response $response, Server $server)
    {
        $this->jsonResponse($response, [
            'server' => $request->server,
            'routes' => Router::getCurrentRoutes(),
            'can_restart' => (bool) env('SWOOLE_HTTP_CAN_RELOAD', false),
        ]);
    }
}
