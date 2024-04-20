<?php

namespace HomeeApi\Entity\Node;

use DateTimeInterface;
use Exception;
use HomeeApi\Entity\Node;
use HomeeApi\Entity\PropertyFactoryTrait;
use ReflectionException;

class NodeAttribute
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?int $node_id = null;
    public ?Node $node = null;
    public ?int $instance = null;
    public ?int $minimum = null;
    public ?int $maximum = null;
    public ?float $current_value = null;
    public ?float $target_value = null;
    public ?float $last_value = null;
    public ?string $unit = null;
    public ?float $step_value = null;
    public ?int $editable = null;
    public ?int $type = null;
    public ?int $state = null;
    public ?DateTimeInterface $last_changed = null;
    public ?int $changed_by = null;
    public ?int $changed_by_id = null;
    public ?int $based_on = null;
    public ?string $data = null;
    public ?string $name = null;
    public ?array $options = null;

    public ?string $type_label = null;
    public ?string $state_label = null;
    public ?string $changed_by_label = null;
    public ?string $based_on_label = null;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data, ?Node $node = null): NodeAttribute
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $nodeAttribute = new NodeAttribute();
        $nodeAttribute->node = $node;
        foreach ($data as $property => $value) {
            self::setProperty($nodeAttribute, $property, $value);
        }

        return $nodeAttribute;
    }

}
