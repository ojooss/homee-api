<?php
declare(strict_types=1);

namespace tests;

use GuzzleHttp\Exception\GuzzleException;
use HomeeApi\Exception\HomeeApiException;
use HomeeApi\HomeeApi;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

final class HomeeApiTest extends TestCase
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
     * @group needs-homee
     * @covers \HomeeApi\HomeeApi::init
     * @covers \HomeeApi\HomeeApi::getAccessToken
     *
     * @throws GuzzleException
     * @throws HomeeApiException
     * @throws InvalidArgumentException
     */
    public function testInit(): void
    {
        $cache = new FilesystemAdapter();
        $cacheItem = $cache->getItem('homee.access_token');

        $logger = $this->createMock(LoggerInterface::class);

        $homeeApi = new HomeeApi(
            $this->getEnv('HOMEE_HOST')
        );
        $homeeApi->setLogger($logger);

        $homeeApi->init(
            $this->getEnv('HOMEE_USERNAME'),
            $this->getEnv('HOMEE_PASSWORD'),
            $cacheItem
        );
        // check access token
        self::assertNotEmpty($homeeApi->getAccessToken());
        // check cache item
        self::assertNotEmpty($cacheItem->get());
    }
}
