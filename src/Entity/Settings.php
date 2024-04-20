<?php /** @noinspection PhpUnused */

namespace HomeeApi\Entity;

use DateTimeInterface;
use Exception;
use ReflectionException;

class Settings
{
    use PropertyFactoryTrait;

    public ?string $address = null;
    public ?string $city = null;
    public ?string $zip = null;
    public ?string $state = null;
    public ?float $latitude = null;
    public ?float $longitude = null;
    public ?string $country = null;
    public ?string $language = null;
    public ?int $remote_access = null;
    public ?int $beta = null;
    public ?string $webhooks_key = null;
    public ?int $automatic_location_detection = null;
    public ?int $polling_interval = null;
    public ?string $timezone = null;
    public ?int $enable_analytics = null;
    public ?string $homee_name = null;
    public ?string $b2b_partner = null;
    public ?int $local_ssl_enabled = null;
    public ?int $wlan_enabled = null;
    public ?string $wlan_ip_address = null;
    public ?string $wlan_ssid = null;
    public ?int $wlan_mode = null;
    public ?int $internet_access = null;
    public ?int $lan_enabled = null;
    public ?array $available_ssids = null;
    public ?DateTimeInterface $time = null;
    public ?DateTimeInterface $civil_time = null;
    public ?string $version = null;
    public ?string $uid = null;
    public ?array $cubes = null;
    public ?array $extensions = null;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): Settings
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $node = new Settings();
        foreach ($data as $property => $value) {
            self::setProperty($node, $property, $value);
        }

        return $node;
    }
}
