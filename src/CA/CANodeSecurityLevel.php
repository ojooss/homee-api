<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CANodeSecurityLevel extends CA
{
    public const CANodeSecurityLevelUnsecure = 0;
    public const CANodeSecurityLevelS0 = 1;
    public const CANodeSecurityLevelS2Unauthenticated = 2;
    public const CANodeSecurityLevelS2Authenticated = 3;
    public const CANodeSecurityLevelS2Access = 4;
    public const CANodeSecurityLevelS0Possible = 16;
    public const CANodeSecurityLevelS2Possible = 17;
    public const CANodeSecurityLevelSecurityOK = 31;

    protected static array $mapping = [
        0 => 'LevelUnsecure',
        1 => 'LevelS0',
        2 => 'LevelS2Unauthenticated',
        3 => 'LevelS2Authenticated',
        4 => 'LevelS2Access',
        16 => 'LevelS0Possible',
        17 => 'LevelS2Possible',
        31 => 'LevelSecurityOK',
    ];
}
