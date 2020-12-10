<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class CookiesTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testCookiesNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->cookie(["hello" => "world", "iam" => "dual"])
            ->get("https://httpbin.org/cookies");

        $this->assertEquals("world", $result->json->cookies->hello);
        $this->assertEquals("dual", $result->json->cookies->iam);
    }

    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testCookiesCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->cookie(["hello" => "world", "iam" => "dual"])
            ->get("https://httpbin.org/cookies");

        $this->assertEquals("world", $result->json->cookies->hello);
        $this->assertEquals("dual", $result->json->cookies->iam);
    }
}