<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->get("https://httpbin.org/json");

echo "<pre>";
print_r($browser->json);
echo "</pre>";