<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
echo $browser->patch("https://httpbin.org/patch", array("foo" => "bar", "drink" => "beer"));