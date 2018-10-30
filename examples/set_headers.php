<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->headers(array(
    "Foo: Bar",
    "Drink: Beer"
));
echo $browser->get("https://httpbin.org/get");