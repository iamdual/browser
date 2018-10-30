<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
echo $browser->post("https://httpbin.org/post", array("foo" => "bar", "drink" => "beer"));