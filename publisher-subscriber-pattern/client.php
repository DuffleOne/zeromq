<?php

$context = new ZMQContext();

$client = new ZMQSocket($context, ZMQ::SOCKET_SUB);
$client->connect("tcp://localhost:5555");

$filter = 'user.created';
$client->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, $filter);

while (true) {
    $string = $client->recv();
    list($name, $payload) = explode('||', $string, 2);

    $event = json_decode($payload, true);
    var_dump($event);
}