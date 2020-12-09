<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $defaults = [
        "user_agent" => "Default/1.0",
        "referer" => "https://github.com/iamdual"
    ];
    $client = Client::create($defaults);
    $result = $client->get("http://httpbin.org/headers");
    var_dump($result->json->headers);
} catch (\Exception $e) {
    echo $e->getMessage();
}