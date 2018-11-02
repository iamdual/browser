<?php
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    public function testGetRequest()
    {
        $browser = new \iamdual\Browser();
        $browser->get("https://httpbin.org/get");
        $this->assertEquals(200, $browser->code);
    }

    public function testPostRequest()
    {
        $browser = new \iamdual\Browser();
        $browser->post("https://httpbin.org/post");
        $this->assertEquals(200, $browser->code);
    }

    public function testPutRequest()
    {
        $browser = new \iamdual\Browser();
        $browser->put("https://httpbin.org/put");
        $this->assertEquals(200, $browser->code);
    }

    public function test405Request()
    {
        $browser = new \iamdual\Browser();
        $browser->get("https://httpbin.org/patch");
        $this->assertEquals(405, $browser->code);
    }
}