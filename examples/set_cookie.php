<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->cookie(["foo" => "bar", "iam" => "dual"]]);
echo $browser->get("https://httpbin.org/get");