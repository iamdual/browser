<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->header("Foo: Bar");
$browser->header("Bar: Baz");
echo $browser->get("https://httpbin.org/get");