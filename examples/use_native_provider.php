<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $client = Client::create(null, Client::PROVIDER_NATIVE);
    $client->json(["hello" => "world", "user_id" => "3048763"]);
    $result = $client->post("https://httpbin.org/post");
    var_dump($result);
} catch (\Exception $e) {
    echo $e->getMessage();
}