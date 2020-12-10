<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class FollowLocationTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testFollowLocationNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->get("http://www.github.com/iamdual");

        $this->assertNotEmpty($result->body);
        $this->assertArrayHasKey("server", $result->headers);
        $this->assertArrayHasKey("location", $result->headers);
        $this->assertEquals("https://github.com/iamdual", $result->url);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testFollowLocationCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->get("http://www.github.com/iamdual");

        $this->assertNotEmpty($result->body);
        $this->assertArrayHasKey("server", $result->headers);
        $this->assertArrayHasKey("location", $result->headers);
        $this->assertEquals("https://github.com/iamdual", $result->url);
    }
}