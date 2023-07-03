<?php

use HomeeApi\MessageHandlerInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class GetAllHandler implements MessageHandlerInterface
{

    public function getLogFile(): string
    {
        return __DIR__ . '/GetAllHandler.log';
    }

    /**
     * @throws JsonException
     */
    public function handle(MessageInterface $message): void
    {
        $logFile = $this->getLogFile();

        $payload = $message->getPayload();
        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        if (isset($data['all'])) {
            $data = $data['all'];
        }

        try {
            if (isset($data['homeegrams'])) {
                foreach ($data['homeegrams'] as $homeegramData) {
                    $homeegram = \HomeeApi\Entity\Homeegram::factory($homeegramData);
                    file_put_contents(
                        $logFile,
                        print_r($homeegram, true) . PHP_EOL,
                        FILE_APPEND
                    );
                }
            }

            file_put_contents(
                __DIR__ . '/raw.txt',
                print_r($data, true) . PHP_EOL,
                FILE_APPEND
            );

        } catch (Exception $e) {
            file_put_contents(
                $logFile,
                PHP_EOL . 'ERROR: ' . $e->getMessage() . PHP_EOL . PHP_EOL . PHP_EOL,
                FILE_APPEND
            );
        }
    }
}
