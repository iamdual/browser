<?php
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    public function testHeaders()
    {
        $browser = new \iamdual\Browser();
        $browser->headers(["Drink: Beer"]);
        $browser->get("https://httpbin.org/get");
        $this->assertEquals("Beer", $browser->json->headers->Drink);
    }
}