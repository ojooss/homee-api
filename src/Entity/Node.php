<?php

namespace HomeeApi\Entity;

use DateTimeInterface;
use Exception;
use HomeeApi\Entity\Node\NodeAttribute;
use ReflectionException;

class Node
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?string $name = null;
    public ?int $profile = null;
    public ?string $image = null;
    public ?int $favorite = null;
    public ?int $order = null;
    public ?int $protocol = null;
    public ?int $routing = null;
    public ?int $state = null;
    public ?DateTimeInterface $state_changed = null;
    public ?DateTimeInterface $added = null;
    public ?int $history = null;
    public ?int $cube_type = null;
    public ?string $note = null;
    public ?int $services = null;
    public ?string $phonetic_name = null;
    public ?int $owner = null;
    public ?int $security = null;
    public array $attributes = [];

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): Node
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $node = new Node();
        foreach ($data as $property => $value) {
            if ($property === 'attributes') {
                foreach ($value as $item) {
                    $node->attributes[] = NodeAttribute::factory($item, $node);
                }
                continue;
            }

            self::setProperty($node, $property, $value);
        }

        return $node;
    }
}
