<?php

namespace Web\ServerHandlers;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

class Router
{
    private const ROUTE_URI = 0;
    private const ROUTE_HANDLER = 1;
    private const ROUTE_HTTP_METHOD = 2;
    private const CONTROLLERS_NAMESPACE = '\\Web\\Controllers\\Http\\';
    private static $routes = [];

    public static function get(string $uri, string $handler)
    {
        self::$routes[] = [$uri, $handler, 'GET'];
    }

    public static function handle(Request $request, Response $response, Server $server)
    {
        try {
            $found = false;
            $requestUri = data_get($request->server, '[request_uri]');

            foreach (self::$routes as $route) {
                $uri = $route[self::ROUTE_URI];
                $handler = $route[self::ROUTE_HANDLER];

                if ($requestUri === $uri) {
                    $found = true;
                    [$handlerController, $handlerMethod] = explode('@', $handler);
                    $handlerControllerWithNamespace = self::CONTROLLERS_NAMESPACE . $handlerController;
                    (new $handlerControllerWithNamespace())->$handlerMethod($request, $response, $server);
                }
            }

            if (!$found) {
                $response->header('Content-Type', 'application/json');
                $response->status(404);
                $response->end();
            }
        } catch (\Throwable $e) {
            echo sprintf("Error on Router::handler --- %s", $e->getMessage());
        }
    }

    public static function getCurrentRoutes()
    {
        return self::$routes;
    }
}
