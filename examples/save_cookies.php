<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->cookies_enabled();
$browser->get("https://httpbin.org/cookies/set/first_try/true"); # set first_try cookie
$browser->get("https://httpbin.org/cookies/set/second_try/true"); # set second_try cookie
echo $browser->get("https://httpbin.org/cookies"); # print all cookies