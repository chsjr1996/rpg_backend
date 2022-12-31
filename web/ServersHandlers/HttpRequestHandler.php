<?php

namespace Web\ServersHandlers;

use DI\Container;
use Swoole\Http\Request;
use Web\Controllers\Http\NotFoundController;

class HttpRequestHandler
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

    public static function onRequest(Container $container)
    {
        try {
            /** @var Request */
            $request = $container->get(Request::class);

            $found = false;
            $requestUri = data_get($request->server, '[request_uri]');

            foreach (self::$routes as $route) {
                $uri = $route[self::ROUTE_URI];
                $handler = $route[self::ROUTE_HANDLER];

                if ($requestUri === $uri) {
                    $found = true;
                    [$handlerController, $handlerMethod] = explode('@', $handler);
                    $handlerControllerWithNamespace = self::CONTROLLERS_NAMESPACE . $handlerController;
                    (new $handlerControllerWithNamespace($container))->$handlerMethod();
                }
            }

            if (!$found) {
                (new NotFoundController($container))->index();
            }
        } catch (\Throwable $e) {
            console_out_error(sprintf("Error on HttpRequestHandler::init --- %s", $e->getMessage()));
        }
    }

    public static function getCurrentRoutes()
    {
        return self::$routes;
    }
}
