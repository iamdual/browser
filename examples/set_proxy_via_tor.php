<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->proxy("socks5://127.0.0.1:9050", null, null, CURLPROXY_SOCKS5);
echo $browser->get("https://check.torproject.org/");