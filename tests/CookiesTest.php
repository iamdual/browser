<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class CookiesTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testCookiesNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->cookie(["hello" => "world", "user_id" => "3048763"])
            ->get("https://httpbin.org/cookies");

        $this->assertEquals("world", $result->json->cookies->hello);
        $this->assertEquals("3048763", $result->json->cookies->user_id);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testCookiesCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->cookie(["hello" => "world", "user_id" => "3048763"])
            ->get("https://httpbin.org/cookies");

        $this->assertEquals("world", $result->json->cookies->hello);
        $this->assertEquals("3048763", $result->json->cookies->user_id);
    }
}