<?php
use PHPUnit\Framework\TestCase;

final class CookiesTest extends TestCase
{
    public function testSaveCookies()
    {
        $browser = new \iamdual\Browser();
        $browser->cookies_enabled();
        $browser->get("https://httpbin.org/cookies/set/first_try/true");
        $browser->get("https://httpbin.org/cookies/set/second_try/true");
        $browser->get("https://httpbin.org/cookies");
        $this->assertObjectHasAttribute("first_try", $browser->json->cookies);
        $this->assertObjectHasAttribute("second_try", $browser->json->cookies);
    }
}