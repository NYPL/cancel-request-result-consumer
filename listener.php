<?php
require __DIR__ . '/vendor/autoload.php';

use NYPL\Starter\Config;
use NYPL\CancelRequestResultConsumer\CancelRequestResultConsumerListener;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;

Config::initialize(__DIR__);

$listener = new CancelRequestResultConsumerListener();

$listener->process(
    new KinesisEvents(),
    'CancelRequestResult'
);
