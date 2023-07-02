<?php

namespace HomeeApi\Entity\Homeegram\Trigger;

use DateTimeInterface;

class TimeTrigger
{
    public ?int $id = null;
    public ?int $homeegram_id = null;
    public ?DateTimeInterface $dtstart = null;
    public ?string $rrule = null;
    public ?DateTimeInterface $next_invocation = null;
}
