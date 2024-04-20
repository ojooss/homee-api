<?php

namespace HomeeApi\Tests;

use HomeeApi\CA\CA;
use HomeeApi\CA\CADeviceType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CA::class)]
class CATest extends TestCase
{
    /**
     * @return void
     */
    public function testGet()
    {
        self::assertEquals(
            CADeviceType::CADeviceTypeDesktop,
            CADeviceType::getValueByConst('CADeviceTypeDesktop')
        );

        self::assertEquals(
            CADeviceType::CADeviceTypeDesktop,
            CADeviceType::getValueByName('CADeviceTypeDesktop')
        );
        self::assertEquals(
            CADeviceType::CADeviceTypeDesktop,
            CADeviceType::getValueByName('Desktop')
        );

        self::assertEquals(
            'Desktop',
            CADeviceType::getNameByValue(CADeviceType::CADeviceTypeDesktop)
        );
    }
}
