<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class MethodsTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testPutMethodNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->json(["hello" => "world", "user_id" => "3048763"])
            ->put("https://httpbin.org/put");

        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("3048763", $result->json->json->user_id);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testPutMethodCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->json(["hello" => "world", "user_id" => "3048763"])
            ->put("https://httpbin.org/put");

        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("3048763", $result->json->json->user_id);
    }
}