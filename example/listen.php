<?php

use HomeeApi\Homee;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/NodeAttributeHandler.php';

echo "*******************************" . PHP_EOL;
echo "***     Listen to Homee     ***" . PHP_EOL;
echo "*******************************" . PHP_EOL;

$logger = new Logger('MyLogger');
$streamHandler = new StreamHandler(__DIR__ . '/sample.log', Level::Debug);
$logger->pushHandler($streamHandler);
$logger->info('startet ' . basename(__FILE__));

$homee = new Homee(getenv('HOMEE_HOST'), $logger);

echo " [i] init connection" . PHP_EOL;
$homee->init(getenv('HOMEE_USERNAME'), getenv('HOMEE_PASSWORD'));

echo " [i] register test handler" . PHP_EOL;
$nodeAttributeHandler = new NodeAttributeHandler();
$homee->addHandler($nodeAttributeHandler);

require_once __DIR__ . '/RawHandler.php';
$handler = new RawHandler();
$homee->addHandler($handler);

echo " [i] listen and write to " . $nodeAttributeHandler->getLogFile() . PHP_EOL;
$homee->listen();
