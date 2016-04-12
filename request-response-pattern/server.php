<?php

$context = new ZMQContext();

$server = new ZMQSocket($context, ZMQ::SOCKET_REP);
$server->bind("tcp://*:5555");

while (true) {
    $request = $server->recv();
    echo("Received request: " . $request . "\n");

    $server->send($request);
}