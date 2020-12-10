<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class JSONTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testJSONNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->json(["hello" => "world", "iam" => "dual"])
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "application/json",
            $result->json->headers->{"Content-Type"}
        );
        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("dual", $result->json->json->iam);
    }

    /**
     * @covers \Iamdual\Browser\Client
     * @throws \Iamdual\Browser\Exception\ProviderNotFoundException
     */
    public function testJSONCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->json(["hello" => "world", "iam" => "dual"])
            ->post("https://httpbin.org/post");

        $this->assertEquals(
            "application/json",
            $result->json->headers->{"Content-Type"}
        );

        $this->assertEquals("world", $result->json->json->hello);
        $this->assertEquals("dual", $result->json->json->iam);
    }
}