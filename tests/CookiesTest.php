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

    public function testSetCookies()
    {
        $browser = new \iamdual\Browser();
        $browser->cookie("foo=bar;iam=dual");
        $browser->get("https://httpbin.org/cookies");
        $this->assertEquals("bar", $browser->json->cookies->foo);
        $this->assertEquals("dual", $browser->json->cookies->iam);
    }

    public function testSetCookies2()
    {
        $browser = new \iamdual\Browser();
        $browser->cookie(["foo" => "bar", "iam" => "dual"]);
        $browser->get("https://httpbin.org/cookies");
        $this->assertEquals("bar", $browser->json->cookies->foo);
        $this->assertEquals("dual", $browser->json->cookies->iam);
    }
}