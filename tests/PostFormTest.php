<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class PostFormTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testPostFormNative(): void
    {
        $result = Client::create(null, Client::PROVIDER_NATIVE)
            ->post("https://httpbin.org/post", [
                "hello" => "world",
                "user_id" => "3048763"
            ]);

        $this->assertEquals("world", $result->json->form->hello);
        $this->assertEquals("3048763", $result->json->form->user_id);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testPostFormCurl(): void
    {
        $result = Client::create(null, Client::PROVIDER_CURL)
            ->post("https://httpbin.org/post", [
                "hello" => "world",
                "user_id" => "3048763"
            ]);

        $this->assertEquals("world", $result->json->form->hello);
        $this->assertEquals("3048763", $result->json->form->user_id);
    }
}