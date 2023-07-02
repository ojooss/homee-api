<?php

namespace HomeeApi\Entity\Homeegram\Trigger;

use HomeeApi\Entity\PropertyFactoryTrait;

class SwitchTrigger
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?int $homeegram_id = null;
}
