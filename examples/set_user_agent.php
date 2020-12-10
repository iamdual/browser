<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $result = Client::create()
        ->userAgent("Unicorn/1.0")
        ->get("http://httpbin.org/headers");

    echo $result->json->headers->{"User-Agent"};
} catch (\Exception $e) {
    echo $e->getMessage();
}