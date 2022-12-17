<?php

namespace App;

use Swoole\WebSocket\Server;

class SwooleSocket
{
    public static function start(): void
    {
        $socketEnabled = (bool) env('SWOOLE_SOCKET_ENABLED', false);
        $httpEnabled = (bool) env('SWOOLE_HTTP_ENABLED', false);

        if (!$socketEnabled) {
            echo "Swoole Socket is not enabled, aborting...";
            return;
        } else if ($socketEnabled && $httpEnabled) {
            echo "Swoole Http is enabled, aborting the socket...";
            return;
        }

        $socketServer = new Server(env('SWOOLE_SOCKET_HOST', '0.0.0.0'), env('SWOOLE_SOCKET_PORT', 9502));

        $socketServer->on('start', function ($socketServer) {
            echo "Swoole Socket server is started at ws://{$socketServer->host}:{$socketServer->port}\n";
        });

        $socketServer->on('open', function ($server, $req) {
            echo "connection open: {$req->fd}\n";
        });

        $socketServer->on('message', function ($server, $frame) {
            echo "Client {$frame->fd} was sent a message {$frame->data}\n";

            foreach ($server->connections as $connection) {
                if ($connection === $frame->fd) {
                    continue;
                }

                $server->push($connection, $frame->data);
            }
        });

        $socketServer->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });

        $socketServer->start();
    }
}
