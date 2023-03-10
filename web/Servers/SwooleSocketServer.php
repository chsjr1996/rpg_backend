<?php

namespace Web\Servers;

use Swoole\WebSocket\Server;

class SwooleSocketServer extends BaseSwooleServer
{
    public function start(): void
    {
        if (!$this->isSocketEnabled()) {
            console_out_warning('Swoole Socket is not enabled, aborting...');
            return;
        } 

        $socketServer = new Server($this->getSocketHost(), $this->getSocketPort());

        $socketServer->on('start', function ($socketServer) {
            echo "Swoole Socket server is started at ws://{$socketServer->host}:{$socketServer->port}", PHP_EOL;
        });

        $socketServer->on('open', function ($server, $req) {
            echo "connection open: {$req->fd}", PHP_EOL;
        });

        $socketServer->on('message', function ($server, $frame) {
            echo "Client {$frame->fd} was sent a message {$frame->data}", PHP_EOL;

            foreach ($server->connections as $connection) {
                if ($connection === $frame->fd) {
                    continue;
                }

                $server->push($connection, $frame->data);
            }
        });

        $socketServer->on('close', function ($server, $fd) {
            echo "connection close: {$fd}", PHP_EOL;
        });

        $socketServer->start();
    }
}
