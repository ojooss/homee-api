<?php

use HomeeApi\Homee;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/GetAllHandler.php';

echo "*************************************" . PHP_EOL;
echo "***     Get all from to Homee     ***" . PHP_EOL;
echo "*************************************" . PHP_EOL;

$logger = new Logger('MyLogger');
$streamHandler = new StreamHandler(__DIR__ . '/sample.log', Level::Debug);
$logger->pushHandler($streamHandler);
$logger->info('startet ' . basename(__FILE__));

$homee = new Homee(getenv('HOMEE_HOST'), $logger);

echo " [i] init connection" . PHP_EOL;
$homee->init(getenv('HOMEE_USERNAME'), getenv('HOMEE_PASSWORD'));

echo " [i] register test handler" . PHP_EOL;
$homeegramHandler = new GetAllHandler();
$homee->addHandler($homeegramHandler);

echo " [i] get all and write to " . $homeegramHandler->getLogFile() . PHP_EOL;
$homee->getHomeeAll();

echo PHP_EOL . PHP_EOL;
