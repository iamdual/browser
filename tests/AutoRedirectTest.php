<?php
use PHPUnit\Framework\TestCase;

final class AutoRedirectTest extends TestCase
{
    public function testAutoRedirect()
    {
        $browser = new \iamdual\Browser();
        $browser->get("http://www.github.com/iamdual/browser");
        $this->assertEquals("https://github.com/iamdual/browser", $browser->url);
    }
}