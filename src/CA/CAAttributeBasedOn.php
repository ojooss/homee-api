<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CAAttributeBasedOn extends CA
{

    public const CAAttributeBasedOnEvents = 1;
    public const CAAttributeBasedOnInterval = 2;
    public const CAAttributeBasedOnPolling = 4;
    public const CAAttributeBasedOnManual = 8;

    protected static array $mapping = [
        1 => 'Events',
        2 => 'Interval',
        4 => 'Polling',
        8 => 'Manual',
    ];
}
