<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->proxy("http://127.0.0.1:8080");
echo $browser->get("https://httpbin.org/get");