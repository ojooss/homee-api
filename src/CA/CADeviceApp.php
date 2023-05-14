<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceApp
{
    public const CADeviceAppNone = 0;
    public const CADeviceAppHomee = 1;
    public const CADeviceAppAFRISOhome = 2;
    public const CADeviceAppESTMK = 3;
    public const CADeviceAppCoviva = 4;
    public const CADeviceAppPuM = 5;
    public const CADeviceAppCovivaBerker = 6;
    public const CADeviceAppNVB = 7;
    public const CADeviceAppTEN = 9;
    public const CADeviceAppHoermann = 11;
    public const CADeviceAppQuarZ = 12;
    public const CADeviceAppVARIA3 = 13;

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
