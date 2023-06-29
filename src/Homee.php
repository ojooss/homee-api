<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi;

use DateTime;
use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException as GuzzleConnectException;
use GuzzleHttp\Exception\GuzzleException;
use HomeeApi\CA\CADeviceApp;
use HomeeApi\CA\CADeviceOS;
use HomeeApi\CA\CADeviceType;
use HomeeApi\Exception\ConnectException;
use HomeeApi\Exception\RequestException;
use HomeeApi\Exception\ResponseException;
use HomeeApi\Exception\RuntimeException;
use Psr\Cache\CacheItemInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\LoggerInterface;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface;
use React\EventLoop\Loop;

class Homee
{

    private ?HttpClient $httpClient;
    private ?LoggerInterface $logger;
    private ?string $accessToken = null;
    private string $host;
    private string $deviceName = 'homeeApi';

    /**
     * @var array<MessageHandlerInterface>
     */
    private array $messageHandlers = [];

    public function __construct(
        string           $host,
        ?LoggerInterface $logger = null,
        ?HttpClient $httpClient = null
    )
    {
        $this->host = $host;
        $this->logger = $logger;
        $this->httpClient = $httpClient;
    }

    protected function getHttpUrl(): string
    {
        return 'http://' . $this->host . ':7681';
    }

    protected function getWebSocketUrl(): string
    {
        return 'ws://' . $this->host . ':7681';
    }

    public function getHttpClient(): HttpClient
    {
        if ($this->httpClient === null) {
            $this->httpClient = new HttpClient();
        }
        return $this->httpClient;
    }

    public function setHttpClient(HttpClient $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(?LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    public function getAccessToken(): string
    {
        if (null === $this->accessToken) {
            throw new RuntimeException('not initialised');
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

    public function addHandler(MessageHandlerInterface $handler): void
    {
        $this->messageHandlers[] = $handler;
    }

    protected function getConnector(): \React\Socket\Connector
    {
        return new \React\Socket\Connector([
            'dns' => '8.8.8.8',
            'timeout' => 10,
        ]);
    }

    /**
     * @throws ResponseException
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

        $url = $this->getHttpUrl() . '/access_token';
        $authString = $username . ':' . hash('sha512', $password);

        try {
            $response = $this->getHttpClient()->request(
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
        } catch (GuzzleConnectException $e) {
            throw new ConnectException($e->getMessage(), $e->getRequest(), $e);
        } catch (RequestException $e) {
            throw new RequestException($e->getMessage(), $e->getRequest(), $e->getResponse(), $e);
        } catch (ClientExceptionInterface $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() != 200) {
            $this->logger?->critical(
                'HomeeApi: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase(),
                [
                    'response' => $response->getBody()->getContents()
                ]
            );
            throw new ResponseException($response);
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

    /**
     * @throws ResponseException
     */
    public function getHomeeLog(): string
    {
        $url = $this->getHttpUrl() . '/logfile.log';
        try {
            $response = $this->getHttpClient()->request(
                'GET',
                $url,
                ['query' => ['access_token' => $this->getAccessToken()]]
            );
        } catch (GuzzleException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() != 200) {
            $this->logger?->critical(
                'HomeeApi: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase(),
                ['response' => $response->getBody()->getContents()]
            );
            throw new ResponseException($response);
        }
        return $response->getBody()->getContents();
    }


    protected function sendCommand(string $command): void
    {
        $url = $this->getWebSocketUrl() . '/connection?access_token=' . $this->getAccessToken();

        $reactConnector = $this->getConnector();
        $loop = Loop::get();
        $connector = new Connector($loop, $reactConnector);
        $connector(
            $url,
            ['v2'],
            ['Origin' => $this->getHttpUrl(), 'protocolVersion' => 13]
        )
        ->then(
            function (WebSocket $conn) use($command) {
                $conn->on('message', function (MessageInterface $msg) use ($conn, $command) {
                    $this->logger?->info('HomeeApi: received message: ' . $msg->getPayload());
                    foreach ($this->messageHandlers as $handler) {
                        $handler->handle($msg);
                    }
                    $conn->close();
                });

                $conn->on('close', function ($code = null, $reason = null) {
                    $this->logger?->info('HomeeApi: Connection closed (code: ' . $code . ' reason: ' . $reason . ')');
                });

                $conn->send($command);
                $this->logger?->debug('HomeeApi: ' . 'sendMessage: ' . $command);
            },
            function (Exception $e) use ($loop) {
                $this->logger?->critical('HomeeApi: Could not connect: ' . $e->getMessage());
                $loop->stop();
            }
        );
    }


    public function listen(): void
    {
        $url = $this->getWebSocketUrl() . '/connection?access_token=' . $this->getAccessToken();

        $reactConnector = $this->getConnector();
        $loop = Loop::get();
        $connector = new Connector($loop, $reactConnector);
        $connector(
            $url,
            ['v2'],
            ['Origin' => $this->getHttpUrl(), 'protocolVersion' => 13]
        )
        ->then(
            function (WebSocket $conn) {
                $conn->on('message', function (MessageInterface $msg) use ($conn) {
                    $this->logger?->info('HomeeApi: received message: ' . $msg->getPayload());
                    foreach ($this->messageHandlers as $handler) {
                        $handler->handle($msg);
                    }
                    #$conn->close();
                });

                $conn->on('close', function ($code = null, $reason = null) {
                    $this->logger?->info('HomeeApi: Connection closed (code: ' . $code . ' reason: ' . $reason . ')');
                });

            },
            function (Exception $e) use ($loop) {
                $this->logger?->critical('HomeeApi: Could not connect: ' . $e->getMessage());
                $loop->stop();
                throw $e;
            }
        );
    }

    public function getHomeeSettings(): void
    {
        $this->sendCommand('GET:settings');
    }

    public function getHomeeAll(): void
    {
        $this->sendCommand('GET:all');
    }

    public function getHomeeNodes(): void
    {
        $this->sendCommand('GET:nodes');
    }

    public function getHomeeHomeegrams(): void
    {
        $this->sendCommand('GET:homeegrams');
    }

    public function getHomeeGroups(): void
    {
        $this->sendCommand('GET:groups');
    }

    public function getHomeeRelationships(): void
    {
        $this->sendCommand('GET:relationships');
    }
}
