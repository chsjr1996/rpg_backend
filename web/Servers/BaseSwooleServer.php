<?php

namespace Web\Servers;

abstract class BaseSwooleServer
{
    protected function getHttpHost(): string
    {
        return env('SWOOLE_HTTP_HOST', '0.0.0.0');
    }

    protected function getHttpPort(): int
    {
        return (int) env('SWOOLE_HTTP_PORT', 9501);
    }

    protected function getSocketHost(): string
    {
        return env('SWOOLE_SOCKET_HOST', '0.0.0.0');
    }

    protected function getSocketPort(): int
    {
        return (int) env('SWOOLE_SOCKET_PORT', 9502);
    }

    protected function isHttpEnabled()
    {
        $enabled = (bool) env('SWOOLE_HTTP_ENABLED', false);
        $host = $this->getHttpHost();
        $port = $this->getHttpPort();

        return $enabled && $host && $port;
    }

    protected function isSocketEnabled(): bool
    {
        // HTTP is priority, if enabled then socket shouldn't run
        if ($this->isHttpEnabled()) {
            return false;
        }

        $enabled = (bool) env('SWOOLE_SOCKET_ENABLED', false);
        $host = $this->getSocketHost();
        $port = $this->getSocketPort();

        return $enabled && $host && $port;
    }

    abstract protected function start();
}
