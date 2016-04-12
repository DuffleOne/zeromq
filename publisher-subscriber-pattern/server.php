<?php

$context = new ZMQContext();

$server = $context->getSocket(ZMQ::SOCKET_PUB);
$server->bind("tcp://*:5555");

while (true) {
    $event = [];
    $event['code'] = 'user.created';
    $event['name'] = 'A user was created.';
    $event['model'] = [
        'id'         => 1,
        'name'       => 'George Miller',
        'email'      => 'george@duffleman.co.uk',
        'created_at' => time(),
    ];

    $json = json_encode($event);
    echo("Sending {$event['code']}.\n");
    $server->send($event['code'] . "||" . $json);

    sleep(1);
}
