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

    public function testJSONGetRequest2()
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

    public function testSetJSONData()
    {
        $browser = new \iamdual\Browser();
        $browser->json_data(["foo" => "bar"]);
        $browser->post("https://httpbin.org/post");
        $this->assertEquals("application/json", $browser->json->headers->{"Content-Type"});
    }

    public function testSetJSONData2()
    {
        $browser = new \iamdual\Browser();
        $browser->json_data('{"foo":"bar"}');
        $browser->post("https://httpbin.org/post");
        $this->assertEquals('{"foo":"bar"}', $browser->json->data);
    }
}