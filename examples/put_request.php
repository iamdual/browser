<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
echo $browser->put("https://httpbin.org/put", array("foo" => "bar", "drink" => "beer"));