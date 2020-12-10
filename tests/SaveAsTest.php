<?php

use Iamdual\Browser\Client;
use PHPUnit\Framework\TestCase;

final class SaveAsTest extends TestCase
{
    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testSaveAsNative(): void
    {
        $filename = __DIR__ . "/dummy_native.pdf";

        Client::create(null, Client::PROVIDER_NATIVE)
            ->saveAs($filename)
            ->get("https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf");

        $this->assertEquals(true, file_exists($filename));
        $this->assertGreaterThan(0, filesize($filename));
        unlink($filename);
    }

    /**
     * @covers \Iamdual\Browser\Client
     */
    public function testSaveAsCurl(): void
    {
        $filename = __DIR__ . "/dummy_curl.pdf";

        Client::create(null, Client::PROVIDER_CURL)
            ->saveAs($filename)
            ->get("https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf");

        $this->assertEquals(true, file_exists($filename));
        $this->assertGreaterThan(0, filesize($filename));
        unlink($filename);
    }
}