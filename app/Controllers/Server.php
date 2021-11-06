<?php

namespace App\Controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Ratchet;

if (!is_cli()) {
    die('cari apa bro?');
}
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Ratchet()
        )
    ),
    5051
);


try {
    $server->run();
} catch (\Throwable $th) {
    die($th);
}
