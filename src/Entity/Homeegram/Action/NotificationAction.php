<?php

namespace HomeeApi\Entity\Homeegram\Action;

class NotificationAction
{
    public ?int $id = null;
    public ?int $homeegram_id = null;
    public ?int $style = null;
    public ?int $delay = null;
    public ?int $critical = null;
    public ?array $user_ids = null;
    public ?string $message = null;
}
