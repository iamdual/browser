<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class ResponseHeadersTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testResponseHeadersNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->get("https://httpbin.org/");

        $this->assertEquals($result->content_type, $result->headers["content-type"]);
        $this->assertEquals("text/html", $result->headers["content-type"]);
        $this->assertEquals("*", $result->headers["access-control-allow-origin"]);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testResponseHeadersCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->get("https://httpbin.org/");

        $this->assertEquals($result->content_type, $result->headers["content-type"]);
        $this->assertEquals("text/html", $result->headers["content-type"]);
        $this->assertEquals("*", $result->headers["access-control-allow-origin"]);
    }
}