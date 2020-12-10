<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class UserAgentTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testUserAgentNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->userAgent("Unicorn Browser/1.0")
            ->get("https://httpbin.org/headers");

        $this->assertEquals("Unicorn Browser/1.0", $result->json->headers->{"User-Agent"});
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testUserAgentCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->userAgent("Unicorn Browser/1.0")
            ->get("https://httpbin.org/headers");

        $this->assertEquals("Unicorn Browser/1.0", $result->json->headers->{"User-Agent"});
    }
}