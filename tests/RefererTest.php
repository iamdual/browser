<?php
use PHPUnit\Framework\TestCase;

final class RefererTest extends TestCase
{
    public function testReferer()
    {
        $browser = new \iamdual\Browser();
        $browser->referer("https://github.com/iamdual/browser");
        $browser->get("https://httpbin.org/get");
        $this->assertEquals("https://github.com/iamdual/browser", $browser->json->headers->Referer);
    }
}