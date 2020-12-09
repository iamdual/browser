<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $result = Client::create()->get("https://httpbin.org");
    var_dump($result);
} catch (\Exception $e) {
    echo $e->getMessage();
}