<?php

namespace HomeeApi\Entity\Homeegram\Action;

class WebhookAction
{
    public ?int $id = null;
    public ?int $homeegram_id = null;
    public ?int $delay = null;
    public ?string $method = null;
    public ?string $url = null;
    public ?string $body = null;
    public ?string $content_type = null;
}
