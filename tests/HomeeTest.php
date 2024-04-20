<?php
declare(strict_types=1);

namespace HomeeApi\Tests;

use HomeeApi\Exception\ResponseException;
use HomeeApi\Homee;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

#[Group('needs-homee-cube')]
#[CoversClass(Homee::class)]
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
     * @param string $cacheItemKey
     * @return Homee
     * @throws InvalidArgumentException
     * @throws ResponseException
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
