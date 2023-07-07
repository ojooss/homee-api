<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/RawHandler.php';

echo "****************************************************" . PHP_EOL;
echo "***     Trigger Homee to change switch state     ***" . PHP_EOL;
echo "****************************************************" . PHP_EOL;

$logger = new \Monolog\Logger('MyLogger');
$streamHandler = new \Monolog\Handler\StreamHandler(__DIR__ . '/sample.log', \Monolog\Level::Debug);
$logger->pushHandler($streamHandler);
$logger->info('startet ' . basename(__FILE__));

$homee = new \HomeeApi\Homee(getenv('HOMEE_HOST'), $logger);
$homee->setDeviceName('tmp');

echo " [i] init connection" . PHP_EOL;
$homee->init(getenv('HOMEE_USERNAME'), getenv('HOMEE_PASSWORD'));

echo " [i] trigger homee" . PHP_EOL;
$homee->setValue(
    25, // DiningLight
    272, // attribute with type: 1=OnOff
    1 // state: 1=ON / 0=Off
);

echo PHP_EOL . PHP_EOL;
