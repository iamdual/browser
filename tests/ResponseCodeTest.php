<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class ResponseCodeTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testResponseCodeNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->delete("https://httpbin.org/status/403");

        $this->assertEquals(403, $result->code);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testResponseCodeCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->delete("https://httpbin.org/status/403");

        $this->assertEquals(403, $result->code);
    }
}