<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/GetAllHandler.php';

echo "*******************************" . PHP_EOL;
echo "***     Listen to Homee     ***" . PHP_EOL;
echo "*******************************" . PHP_EOL;

$logger = new \Monolog\Logger('MyLogger');
$streamHandler = new \Monolog\Handler\StreamHandler(__DIR__ . '/sample.log', \Monolog\Level::Debug);
$logger->pushHandler($streamHandler);
$logger->info('startet ' . basename(__FILE__));

$homee = new \HomeeApi\Homee(getenv('HOMEE_HOST'), $logger);

echo " [i] init connection" . PHP_EOL;
$homee->init(getenv('HOMEE_USERNAME'), getenv('HOMEE_PASSWORD'));

echo " [i] register test handler" . PHP_EOL;
$homeegramHandler = new GetAllHandler();
$homee->addHandler($homeegramHandler);

echo " [i] get all and write to " . $homeegramHandler->getLogFile() . PHP_EOL;
$homee->getHomeeAll();

echo PHP_EOL . PHP_EOL;
