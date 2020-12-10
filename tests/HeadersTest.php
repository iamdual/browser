<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testHeadersNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->header("X-Custom-Header: 1")
            ->header("X-Fresh-Water: Low")
            ->post("https://httpbin.org/post");

        $this->assertEquals("1", $result->json->headers->{"X-Custom-Header"});
        $this->assertEquals("Low", $result->json->headers->{"X-Fresh-Water"});
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testHeadersCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->header("X-Custom-Header: 1")
            ->header("X-Fresh-Water: Low")
            ->post("https://httpbin.org/post");

        $this->assertEquals("1", $result->json->headers->{"X-Custom-Header"});
        $this->assertEquals("Low", $result->json->headers->{"X-Fresh-Water"});
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testHeaders(): void
    {
        $result = Client::create()
            ->header("X-Custom-Header: 1")
            ->headers(["X-Fresh-Water: Low", "X-Crisis: Yes"])
            ->post("https://httpbin.org/post");

        $this->assertObjectNotHasAttribute("X-Custom-Header", $result->json->headers);
        $this->assertEquals("Low", $result->json->headers->{"X-Fresh-Water"});
        $this->assertEquals("Yes", $result->json->headers->{"X-Crisis"});
    }
}