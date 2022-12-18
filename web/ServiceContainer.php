<?php

namespace Web\Servers;

use DI\Container;

class ServiceContainer
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function boot()
    {
    }

    public function getContainer()
    {
        return $this->container;
    }
}
