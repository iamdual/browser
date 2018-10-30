<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->user_agent("Hello Browser/1.0");
echo $browser->get("https://httpbin.org/get");