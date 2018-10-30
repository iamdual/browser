<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->get("https://httpbin.org/get");
echo $browser->code;