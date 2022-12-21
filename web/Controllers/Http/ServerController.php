<?php

namespace Web\Controllers\Http;

use Web\Services\Handlers\HttpRequestHandler as Route;

class ServerController extends BaseContoller
{
    public function reload()
    {
        if (!(bool) env('SWOOLE_HTTP_CAN_RELOAD', false)) {
            $this->jsonResponse(['message' => 'reload disabled...']);
        }

        if (!$this->server->reload()) {
            $this->jsonResponse(['message' => 'error on reload...'], 500);
        }

        $html = file_get_contents($this->getViewPath('reload.html'));
        $this->htmlResponse($html);
    }

    public function status()
    {
        $this->jsonResponse([
            'server' => $this->request->server,
            'can_restart' => (bool) env('SWOOLE_HTTP_CAN_RELOAD', false),
            'routes' => Route::getCurrentRoutes(),
            'container_names' => $this->container->getKnownEntryNames(),
        ]);
    }
}
