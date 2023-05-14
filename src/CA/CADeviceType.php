<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceType
{
    public const CADeviceTypeNone = 0;
    public const CADeviceTypePhone = 1;
    public const CADeviceTypeTablet = 2;
    public const CADeviceTypeDesktop = 3;
    public const CADeviceTypeBrowser = 4;

    public static function get(string $key): ?int
    {
        $name = static::class . '::' . $key;
        if (defined($name)) {
            return constant($name);
        } else {
            return null;
        }
    }
}
