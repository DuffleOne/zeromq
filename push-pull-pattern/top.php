<?php

$context = new ZMQContext();

$server = new ZMQSocket($context, ZMQ::SOCKET_PUSH);
$server->bind("tcp://*:5555");

echo('Press enter when the other two clients are ready.');
$fp = fopen('php://stdin', 'r');
$line = fgets($fp, 512);
fclose($fp);
echo('Sending tasks to workers...' . PHP_EOL);

$server->send(0);

$total_seconds = 0;
for ($i = 0; $i < 100; $i++) {
    $workload = mt_rand(1, 100);
    $total_seconds += $workload;
    $server->send($workload);
}

echo("Total expected cost: " . $total_seconds);
sleep(1);