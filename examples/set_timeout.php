<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->timeout(1);
echo $browser->get("https://httpbin.org/delay/10");