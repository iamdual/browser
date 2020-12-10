<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testHeadersNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->header("X-Fresh-Water: Low")
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "Low",
            $result->json->headers->{"X-Fresh-Water"}
        );
    }

    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testHeadersCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->header("X-Fresh-Water: Low")
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "Low",
            $result->json->headers->{"X-Fresh-Water"}
        );
    }

    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testHeaders(): void
    {
        $result = Client::create()
            ->headers(["X-Fresh-Water: Low", "X-Crisis: Yes"])
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "Low",
            $result->json->headers->{"X-Fresh-Water"}
        );
    }
}