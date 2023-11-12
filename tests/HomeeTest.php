<?php
declare(strict_types=1);

namespace HomeeApi\Tests;

use HomeeApi\Exception\ResponseException;
use HomeeApi\Homee;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @group needs-homee-cube
 */
final class HomeeTest extends TestCase
{
    private ?FilesystemAdapter $cache = null;

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
     * @throws Exception
     */
    private function getHomee(string $cacheItemKey = 'homee.access_token'): Homee
    {
        // init cache once
        if (null === $this->cache) {
            $this->cache = new FilesystemAdapter();
        }

        $homee = new Homee(
            $this->getEnv('HOMEE_HOST')
        );
        $cacheItem = $this->cache->getItem($cacheItemKey);
        if ($cacheItem->isHit()) {
            $homee->setAccessToken($cacheItem->get());
        } else {
            $homee->init(
                $this->getEnv('HOMEE_USERNAME'),
                $this->getEnv('HOMEE_PASSWORD'),
                $cacheItem
            );
            $this->cache->save($cacheItem);
        }

        return $homee;
    }

    /**
     * @covers \HomeeApi\Homee::init
     * @covers \HomeeApi\Homee::getAccessToken
     *
     * @throws Exception
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
        $cacheItem = $this->cache->getItem($cacheItemKey);
        self::assertNotEmpty($cacheItem->get());
    }

    /**
     * @covers \HomeeApi\Homee::getHomeeLog
     *
     * @throws Exception
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
