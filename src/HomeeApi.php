<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use HomeeApi\CA\CADeviceApp;
use HomeeApi\CA\CADeviceOS;
use HomeeApi\CA\CADeviceType;
use HomeeApi\Exception\HomeeApiException;
use Psr\Cache\CacheItemInterface;
use Psr\Log\LoggerInterface;

class HomeeApi
{

    private ?Client $client;
    private ?LoggerInterface $logger;
    private ?string $accessToken = null;
    private string $host;
    private string $deviceName = 'homeeApi';

    public function __construct(
        string $host,
        ?LoggerInterface $logger = null,
        ?Client $client = null
    ) {
        $this->host = $host;
        $this->logger = $logger;
        $this->client = $client;
    }

    protected function getHomeeApiUrl(): string
    {
        return 'http://' . $this->host . ':7681';
    }

    public function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client();
        }
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(?LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @throws HomeeApiException
     */
    public function getAccessToken(): string
    {
        if (null === $this->accessToken) {
            throw new HomeeApiException('not initialised');
        }
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getDeviceName(): string
    {
        return $this->deviceName;
    }

    public function setDeviceName(string $deviceName): self
    {
        $this->deviceName = $deviceName;
        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws HomeeApiException
     */
    public function init(string $username, string $password, ?CacheItemInterface $cacheItem = null): void
    {
        if ($this->accessToken) {
            return;
        }

        $this->logger?->debug('HomeeApi: going to get new access token');

        // get OperatingSystem
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $operatingSystem = CADeviceOS::CADeviceOSWindows;
        } else {
            $operatingSystem = CADeviceOS::CADeviceOSLinux;
        }

        $url = $this->getHomeeApiUrl() . '/access_token';
        $authString = $username . ':' . hash('sha512', $password);

        $response = $this->getClient()->request(
            'POST',
            $url,
            [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($authString),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Referer' => 'https://my.hom.ee/',
                    'Origin' => 'https://my.hom.ee',
                ],
                'form_params' => [
                    'device_name' => $this->deviceName,
                    'device_hardware_id' => md5($this->deviceName),
                    'device_os' => $operatingSystem,
                    'device_type' => CADeviceType::CADeviceTypeNone,
                    'device_app' => CADeviceApp::CADeviceAppHomee,
                ],
            ],
        );

        if ($response->getStatusCode() != 200) {
            $this->logger?->critical(
                'HomeeApi: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase(),
                [
                    'response' => $response->getBody()->getContents()
                ]
            );
            throw new HomeeApiException(
                $response->getStatusCode() . ' - ' . $response->getReasonPhrase()
            );
        }
        $content = $response->getBody()->getContents();

        $result = [];
        $items = explode('&', $content);
        foreach ($items as $item) {
            $tmp = explode('=', $item);
            $result[$tmp[0]] = $tmp[1];
        }

        $this->accessToken = $result['access_token'];

        $expiresAt = new DateTime();
        $expiresAt->setTimestamp(time() + (int)$result['expires']);
        $expiresAt->modify('-1 day'); // safety first
        $this->logger?->debug(
            'new access token',
            [
                'token' => $this->accessToken,
                'expiresAt' => $expiresAt->format('Y-m-d H:i:s')
            ]
        );

        if ($cacheItem) {
            $cacheItem->set($result['access_token']);
            $cacheItem->expiresAt($expiresAt);
        }
    }
}
