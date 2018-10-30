<?php
require __DIR__ . '/../src/Browser.php';

$browser = new \iamdual\Browser();
echo $browser->get("https://httpbin.org/get");