<?php
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    public function testHeaders()
    {
        $browser = new \iamdual\Browser();
        $browser->header("Drink: Beer");
        $browser->header("Authorization: Bearer IamAToken");
        $browser->get("https://httpbin.org/get");
        $this->assertEquals("Beer", $browser->json->headers->Drink);
        $this->assertEquals("Bearer IamAToken", $browser->json->headers->Authorization);
    }

    public function testHeaders2()
    {
        $browser = new \iamdual\Browser();
        $browser->headers(["Drink: Beer", "Foo: Bar", "Bar: Baz"]);
        $browser->get("https://httpbin.org/get");
        $this->assertEquals("Beer", $browser->json->headers->Drink);
        $this->assertEquals("Bar", $browser->json->headers->Foo);
        $this->assertEquals("Baz", $browser->json->headers->Bar);
    }
}