<?php
declare(strict_types=1);

namespace HomeeApi\Tests;

use HomeeApi\Exception\ResponseException;
use HomeeApi\Homee;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @group needs-homee-cube
 */
final class HomeeTest extends TestCase
{
    protected function getEnv($key): string
    {
        $value = getenv($key);
        if (false === $value) {
            throw new RuntimeException('Missing ENV: ' . $key);
        }
        return $value;
    }

    /**
     * @throws InvalidArgumentException
     * @throws ResponseException
     */
    private function getHomee(string $cacheItemKey = 'homee.access_token'): Homee
    {
        $cache = new FilesystemAdapter();
        $cacheItem = $cache->getItem($cacheItemKey);

        $logger = $this->createMock(LoggerInterface::class);

        $homee = new Homee(
            $this->getEnv('HOMEE_HOST')
        );
        $homee->setLogger($logger);

        $homee->init(
            $this->getEnv('HOMEE_USERNAME'),
            $this->getEnv('HOMEE_PASSWORD'),
            $cacheItem
        );
        return $homee;
    }

    /**
     * @covers \HomeeApi\Homee::init
     * @covers \HomeeApi\Homee::getAccessToken
     *
     * @throws InvalidArgumentException
     * @throws ResponseException
     */
    public function testInit(): void
    {
        $cacheItemKey = 'homee.access_token';
        $client = $this->getHomee($cacheItemKey);
        // check access token
        self::assertNotEmpty($client->getAccessToken());
        // check cache item
        $cache = new FilesystemAdapter();
        $cacheItem = $cache->getItem($cacheItemKey);
        self::assertNotEmpty($cacheItem->get());
    }

    /**
     * @covers \HomeeApi\Homee::getHomeeLog
     *
     * @throws InvalidArgumentException
     * @throws ResponseException
     */
    public function testGetHomeeLog()
    {
        $client = $this->getHomee();
        $log = $client->getHomeeLog();
        self::assertNotEmpty($log);
    }
}
