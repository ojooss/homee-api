<?php

namespace HomeeApi\Entity\Homeegram\Condition;

class AttributeCondition
{
    public ?int $id = null;
    public ?int $homeegram_id = null;
    public ?int $node_id = null;
    public ?int $attribute_id = null;
    public ?int $operator = null;
    public ?int $check_moment = null;
    public ?int $operand = null;
    public ?float $value = null;
}
