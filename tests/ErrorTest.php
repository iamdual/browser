<?php
use PHPUnit\Framework\TestCase;

final class ErrorTest extends TestCase
{
    public function testError()
    {
        $browser = new \iamdual\Browser();
        $browser->get("invld://httpbin.org/get");
        $this->assertNotEquals(null, $browser->error);
    }
}