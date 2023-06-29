<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CAAttributeChangedBy extends CA
{
    public const CAAttributeChangedByNone = 0;
    public const CAAttributeChangedByItself = 1;
    public const CAAttributeChangedByUser = 2;
    public const CAAttributeChangedByHomeegram = 3;
    public const CAAttributeChangedByAI = 6;

    protected static array $mapping = [
        0 => 'None',
        1 => 'Itself',
        2 => 'User',
        3 => 'Homeegram',
        6 => 'AI',
    ];
}
