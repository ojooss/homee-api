<?php

namespace HomeeApi\Tests;

use HomeeApi\CA\CADeviceType;
use PHPUnit\Framework\TestCase;

class CATest extends TestCase
{
    /**
     * @covers \HomeeApi\CA\CA::getValueByConst
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
