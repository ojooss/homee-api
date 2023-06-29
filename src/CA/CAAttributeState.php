<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CAAttributeState extends CA
{
    public const CAAttributeStateNone = 0;
    public const CAAttributeStateNormal = 1;
    public const CAAttributeStateWaitingForWakeUp = 2;
    public const CAAttributeStateWaitingForValue = 3;
    public const CAAttributeStateWaitingForAcknowledge = 4;
    public const CAAttributeStateInactive = 5;
    public const CAAttributeStateIgnored = 6;
    public const CAAttributeStateUnavailable = 7;
    public const CAAttributeStateUnlisted = 9;

    protected static array $mapping = [
        0 => 'None',
        1 => 'Normal',
        2 => 'WaitingForWakeUp',
        3 => 'WaitingForValue',
        4 => 'WaitingForAcknowledge',
        5 => 'Inactive',
        6 => 'Ignored',
        7 => 'Unavailable',
        9 => 'Unlisted',
    ];
}
