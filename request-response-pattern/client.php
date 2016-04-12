<?php

$context = new ZMQContext();

$client = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$client->connect("tcp://venom:5555");

for ($i = 0; $i <= 10; $i++) {
    echo("Sending: Hello " . $argv[1] . "\n");
    $client->send("Hello " . $argv[1]);
    $reply = $client->recv();
    echo("Reply: " . $reply . "\n");
}

