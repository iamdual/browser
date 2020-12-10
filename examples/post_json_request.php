<?php
require __DIR__ . '/vendor/autoload.php';

use Iamdual\Browser\Client;

try {
    $result = Client::create()
        ->json(["hello" => "world", "iam" => "dual"])
        ->post("https://httpbin.org/post");

    var_dump($result->body);
} catch (\Exception $e) {
    echo $e->getMessage();
}