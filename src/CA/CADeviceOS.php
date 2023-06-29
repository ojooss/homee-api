<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceOS extends CA
{
    public const CADeviceOSNone = 0;
    public const CADeviceOSiOS = 1;
    public const CADeviceOSAndroid = 2;
    public const CADeviceOSWindows = 3;
    public const CADeviceOSWindowsPhone = 4;
    public const CADeviceOSLinux = 5;
    public const CADeviceOSMacOS = 6;

    protected static array $mapping = [
        0 => 'None',
        1 => 'iOS',
        2 => 'Android',
        3 => 'Windows',
        4 => 'WindowsPhone',
        5 => 'Linux',
        6 => 'MacOS',
    ];
}
