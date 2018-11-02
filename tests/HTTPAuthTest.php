<?php
use PHPUnit\Framework\TestCase;

final class HTTPAuthTest extends TestCase
{
    public function testHTTPAuth()
    {
        $browser = new \iamdual\Browser();
        $browser->http_auth("foo", "bar");
        $browser->get("https://httpbin.org/basic-auth/foo/bar");
        $this->assertEquals(200, $browser->code);
    }
}