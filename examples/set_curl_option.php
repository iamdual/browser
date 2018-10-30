<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->set_opt(CURLOPT_USERAGENT, "Greetings from set_opt");
$browser->set_opt(CURLOPT_REFERER, "https://github.com/iamdual/browser");
echo $browser->get("https://httpbin.org/get");