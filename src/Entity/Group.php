<?php /** @noinspection DuplicatedCode */

namespace HomeeApi\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use ReflectionException;
use ReflectionProperty;

class Group
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?swtring $name = null;
    public ?string $image = null;
    public ?int $order = null;
    public ?DateTimeInterface $added = null;
    public ?int $state = null;
    public ?int $category = null;
    public ?string $phonetic_name = null;
    public ?string $note = null;
    public ?int $services = null;
    public ?int $owner = null;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): Group
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $group = new Group();
        foreach ($data as $property => $value) {
            self::setProperty($group, $property, $value);
        }

        return $group;
    }
}
