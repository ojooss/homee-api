<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceOS
{
    public const CADeviceOSNone = 0;
    public const CADeviceOSiOS = 1;
    public const CADeviceOSAndroid = 2;
    public const CADeviceOSWindows = 3;
    public const CADeviceOSWindowsPhone = 4;
    public const CADeviceOSLinux = 5;
    public const CADeviceOSMacOS = 6;

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
