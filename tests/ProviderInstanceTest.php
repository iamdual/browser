<?php

use Iamdual\Browser\Client;
use Iamdual\Browser\Provider\Curl;
use Iamdual\Browser\Provider\Native;
use PHPUnit\Framework\TestCase;

final class ProviderInstanceTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testNativeProvider(): void
    {
        $this->assertInstanceOf(
            Native::class,
            Client::create(null, Client::PROVIDER_NATIVE)
        );
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testCurlProvider(): void
    {
        $this->assertInstanceOf(
            Curl::class,
            Client::create(null, Client::PROVIDER_CURL)
        );
    }
}