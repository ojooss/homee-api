<?php /** @noinspection PhpUnused */

/** @noinspection DuplicatedCode */

namespace HomeeApi\Entity;

use Exception;
use ReflectionException;

class Relationship
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?int $group_id = null;
    public ?int $node_id = null;
    public ?int $homeegram_id = null;
    public ?int $order = null;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): Relationship
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $group = new Relationship();
        foreach ($data as $property => $value) {
            self::setProperty($group, $property, $value);
        }

        return $group;
    }
}
