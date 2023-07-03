<?php

namespace HomeeApi\Entity\Homeegram\Condition;

class TimeCondition
{
    public ?int $id = null;
    public ?int $homeegram_id = null;
    public ?\DateTimeInterface $dtstart = null;
    public ?string $rrule = null;
    public ?string $duration = null;
    public ?int $check_moment = null;
}
