<?php

$context = new ZMQContext();
$receiver = new ZMQSocket($context, ZMQ::SOCKET_PULL);
$receiver->bind("tcp://*:5556");

//  Wait for start of batch
$string = $receiver->recv();

//  Start our clock now
$tstart = microtime(true);

//  Process 100 confirmations
$total_seconds = 0;     //  Total calculated cost in msecs
for ($i = 0; $i < 100; $i++) {
    $string = $receiver->recv();
    if ($i % 10 == 0) {
        echo ":";
    } else {
        echo ".";
    }
}

$tend = microtime(true);

$total_seconds = ($tend - $tstart) * 1000;
echo PHP_EOL;
printf("Total elapsed time: %d msec", $total_seconds);
echo PHP_EOL;