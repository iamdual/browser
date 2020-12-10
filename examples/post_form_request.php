<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $result = Client::create()
        ->post("https://httpbin.org/post", ["foo" => "bar"]);

    var_dump($result);
} catch (\Exception $e) {
    echo $e->getMessage();
}