<?php
use PHPUnit\Framework\TestCase;

final class JSONTest extends TestCase
{
    public function testJSONGetRequest()
    {
        $browser = new \iamdual\Browser();
        $browser->get("https://httpbin.org/get");
        $this->assertNotNull($browser->json);
    }

    public function testJSONGetRequest_2()
    {
        $browser = new \iamdual\Browser();
        $browser->get("https://httpbin.org/xml");
        $this->assertNull($browser->json);
    }

    public function testJSONPostRequest()
    {
        $browser = new \iamdual\Browser();
        $browser->post("https://httpbin.org/post", ["foo" => "bar"]);
        $this->assertNotNull($browser->json);
    }
}