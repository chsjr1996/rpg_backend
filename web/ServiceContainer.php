<?php

namespace Web;

use DI\Container;
use Web\Services\Game\CharService;

class ServiceContainer
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function boot()
    {
        $this->container->set(CharService::class, fn () => new CharService());
    }

    public function set(string $name, object $instance): void
    {
        $this->container->set($name, fn () => $instance);
    }

    public function getContainer()
    {
        return $this->container;
    }
}
