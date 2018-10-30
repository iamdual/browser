<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$browser = new Browser();
$browser->json_data('{"foo":"bar","iam":"dual"}');
echo $browser->post("https://httpbin.org/post");