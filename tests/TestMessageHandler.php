<?php /** @noinspection PhpUnused */

namespace HomeeApi\Tests;

use HomeeApi\MessageHandlerInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class TestMessageHandler implements MessageHandlerInterface
{

    public array $stack = [];

    public function __construct(
        protected readonly string $logFile = __DIR__ . '/TestMessageHandler.txt',
    ) {
    }

    public function handle(MessageInterface $message): void
    {
        // put message on stack
        $this->stack[] = $message->getPayload();

        // and write to file
        file_put_contents(
            $this->logFile,
            print_r($message->getPayload(), true) . PHP_EOL . PHP_EOL . PHP_EOL,
            FILE_APPEND
        );
    }
}
