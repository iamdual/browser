<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class DefaultsTest extends TestCase
{
    private function getDefaults() {
        return [
            "user_agent" => "Unicorn Browser/1.0",
            "referer" => "https://github.com/iamdual",
        ];
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testDefaultsNative(): void
    {
        $result = Client::create($this->getDefaults(), Client::PROVIDER_NATIVE)
            ->get("https://httpbin.org/headers");

        $this->assertEquals("Unicorn Browser/1.0", $result->json->headers->{"User-Agent"});
        $this->assertEquals("https://github.com/iamdual", $result->json->headers->{"Referer"});
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testDefaultsCurl(): void
    {
        $result = Client::create($this->getDefaults(), Client::PROVIDER_CURL)
            ->get("https://httpbin.org/headers");

        $this->assertEquals("Unicorn Browser/1.0", $result->json->headers->{"User-Agent"});
        $this->assertEquals("https://github.com/iamdual", $result->json->headers->{"Referer"});
    }
}