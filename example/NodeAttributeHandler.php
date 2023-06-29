<?php

use HomeeApi\CA\CAAttributeBasedOn;
use HomeeApi\CA\CAAttributeChangedBy;
use HomeeApi\CA\CAAttributeState;
use HomeeApi\CA\CAAttributeType;
use HomeeApi\Entity\Node\NodeAttribute;
use HomeeApi\MessageHandlerInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class NodeAttributeHandler implements MessageHandlerInterface
{

    public function getLogFile(): string
    {
        return __DIR__ . '/NodeAttributeHandler.txt';
    }

    /**
     * @throws JsonException
     */
    public function handle(MessageInterface $message): void
    {
        $logFile = $this->getLogFile();

        $payload = $message->getPayload();
        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        try {
            if (isset($data['attribute'])) {
                $nodeAttribute = NodeAttribute::factory($data['attribute']);

                // add labels
                $nodeAttribute->type_label = CAAttributeType::getNameByValue($nodeAttribute->type);
                $nodeAttribute->state_label = CAAttributeState::getNameByValue($nodeAttribute->state);
                $nodeAttribute->changed_by_label = CAAttributeChangedBy::getNameByValue($nodeAttribute->changed_by);
                $nodeAttribute->based_on_label = CAAttributeBasedOn::getNameByValue($nodeAttribute->based_on);

                file_put_contents(
                    $logFile,
                    print_r($nodeAttribute, true) . PHP_EOL,
                    FILE_APPEND
                );
            }
        } catch (Exception $e) {
            file_put_contents(
                $logFile,
                PHP_EOL . 'ERROR: ' . $e->getMessage() . PHP_EOL . PHP_EOL . PHP_EOL,
                FILE_APPEND
            );
        }
    }
}
