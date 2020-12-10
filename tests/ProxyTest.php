<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class ProxyTest extends TestCase
{
    const PROXY_ADDRESS = "127.0.0.1";
    const PROXY_PORT = "8080";

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testProxyNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->proxy(self::PROXY_ADDRESS . ":" . self::PROXY_PORT)
            ->get("https://api.ipify.org?format=json");

        $this->assertEquals(self::PROXY_ADDRESS, $result->json->ip);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testProxyCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->proxy(self::PROXY_ADDRESS . ":" . self::PROXY_PORT)
            ->get("https://api.ipify.org?format=json");

        $this->assertEquals(self::PROXY_ADDRESS, $result->json->ip);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testTorProxyCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->proxy("socks5://127.0.0.1:9050", null, CURLPROXY_SOCKS5)
            ->get("https://check.torproject.org/");

        $this->assertStringContainsString(
            "Congratulations. This browser is configured to use Tor.",
            $result->body
        );
    }
}