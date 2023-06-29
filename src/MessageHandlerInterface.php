<?php

namespace HomeeApi;

use Ratchet\RFC6455\Messaging\MessageInterface;

interface MessageHandlerInterface
{
    public function handle(MessageInterface $message);

}
