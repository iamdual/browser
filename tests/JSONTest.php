<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class JSONTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testJSONNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->json(["hello" => "world", "user_id" => "3048763"])
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "application/json",
            $result->json->headers->{"Content-Type"}
        );
        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("3048763", $result->json->json->user_id);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testJSONCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->json(["hello" => "world", "user_id" => "3048763"])
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "application/json",
            $result->json->headers->{"Content-Type"}
        );

        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("3048763", $result->json->json->user_id);
    }
}