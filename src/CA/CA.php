<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

abstract class CA
{

    protected static array $mapping;

    public static function getValueByConst(string $key): ?int
    {
        $name = static::class . '::' . $key;
        if (defined($name)) {
            return constant($name);
        } else {
            return null;
        }
    }

    public static function getValueByName(string $name): ?int
    {
        // get class name without namespace
        $parts = explode('\\', static::class);
        $className = array_pop($parts);

        // Remove class name from name (is possible)
        $name = str_replace($className, '', $name);

        if ($value = array_search($name, static::$mapping)) {
            return $value;
        } else {
            return null;
        }
    }

    public static function getNameByValue(int $value): ?string
    {
        return static::$mapping[$value] ?? null;
    }
}
