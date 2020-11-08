<?php
use PHPUnit\Framework\TestCase;

final class ResponseHeadersTest extends TestCase
{
    public function testHeaders()
    {
        $browser = new \iamdual\Browser();
        $browser->request("OPTIONS", "https://github.com");
        $this->assertEquals("0", $browser->headers["Content-Length"]);
        $this->assertEquals("deny", $browser->headers["X-Frame-Options"]);
    }
}