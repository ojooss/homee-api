<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CANodeProtocol extends CA
{
    public const CANodeProtocolNone = 0;
    public const CANodeProtocolZWave = 1;
    public const CANodeProtocolZigBee = 2;
    public const CANodeProtocolEnOcean = 3;
    public const CANodeProtocolWMBus = 4;
    public const CANodeProtocolHomematic = 5;
    public const CANodeProtocolKNXRF = 6;
    public const CANodeProtocolInova = 7;
    public const CANodeProtocolHTTPAVM = 8;
    public const CANodeProtocolHTTPNetatmo = 9;
    public const CANodeProtocolHTTPKoubachi = 10;
    public const CANodeProtocolHTTPNest = 11;
    public const CANodeProtocolIOCube = 12;
    public const CANodeProtocolHTTPCCU2 = 13;
    public const CANodeProtocolHTTPUPnP = 14;
    public const CANodeProtocolHTTPNuki = 15;
    public const CANodeProtocolHTTPSEMS = 16;
    public const CANodeProtocolZWaveV3 = 17;
    public const CANodeProtocolLoRa = 18;
    public const CANodeProtocolBiSecur = 19;
    public const CANodeProtocolHTTPWolf = 20;
    public const CANodeProtocolExternalHomee = 21;
    public const CANodeProtocolCentronicPlus = 22;
    public const CANodeProtocolHTTPMyStrom = 24;
    public const CANodeProtocolWMS = 23;
    public const CANodeProtocolHTTPSteca = 25;
    public const CANodeProtocolMQTTShelly = 27;
    public const CANodeProtocolAll = 100;

    protected static array $mapping = [
        0 => 'None',
        1 => 'ZWave',
        2 => 'ZigBee',
        3 => 'EnOcean',
        4 => 'WMBus',
        5 => 'Homematic',
        6 => 'KNXRF',
        7 => 'Inova',
        8 => 'HTTPAVM',
        9 => 'HTTPNetatmo',
        10 => 'HTTPKoubachi',
        11 => 'HTTPNest',
        12 => 'IOCube',
        13 => 'HTTPCCU2',
        14 => 'HTTPUPnP',
        15 => 'HTTPNuki',
        16 => 'HTTPSEMS',
        17 => 'ZWaveV3',
        18 => 'LoRa',
        19 => 'BiSecur',
        20 => 'HTTPWolf',
        21 => 'ExternalHomee',
        22 => 'CentronicPlus',
        24 => 'HTTPMyStrom',
        23 => 'WMS',
        25 => 'HTTPSteca',
        27 => 'MQTTShelly',
        100 => 'All',
    ];
}
