<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADeviceType extends CA
{
    public const CADeviceTypeNone = 0;
    public const CADeviceTypePhone = 1;
    public const CADeviceTypeTablet = 2;
    public const CADeviceTypeDesktop = 3;
    public const CADeviceTypeBrowser = 4;

    protected static array $mapping = [
        0 => 'None',
        1 => 'Phone',
        2 => 'Tablet',
        3 => 'Desktop',
        4 => 'Browser',
    ];
}
