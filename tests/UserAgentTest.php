<?php
use PHPUnit\Framework\TestCase;

final class UserAgentTest extends TestCase
{
    public function testUserAgent()
    {
        $browser = new \iamdual\Browser();
        $browser->user_agent("Hello Browser/1.0");
        $browser->get("https://httpbin.org/get");
        $this->assertEquals("Hello Browser/1.0", $browser->json->headers->{'User-Agent'});
    }
}