<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->request("OPTIONS", "https://github.com");
var_dump($browser->headers);