<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceApp extends CA
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

    protected static array $mapping = [
        0 => 'None',
        1 => 'Homee',
        2 => 'AFRISOhome',
        3 => 'ESTMK',
        4 => 'Coviva',
        5 => 'PuM',
        6 => 'CovivaBerker',
        7 => 'NVB',
        9 => 'TEN',
        11 => 'Hoermann',
        12 => 'QuarZ',
        13 => 'VARIA3',
    ];
}
