<?php

$context = new ZMQContext();

$receiver = new ZMQSocket($context, ZMQ::SOCKET_PULL);
$receiver->connect("tcp://localhost:5555");

$sender = new ZMQSocket($context, ZMQ::SOCKET_PUSH);
$sender->connect("tcp://localhost:5556");

while (true) {
    $string = $receiver->recv();

    //  Simple progress indicator for the viewer
    echo $string, PHP_EOL;

    //  Do the work
    usleep($string * 1000);

    //  Send results to sink
    $sender->send("");
}