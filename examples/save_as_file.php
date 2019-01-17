<?php
require __DIR__ . '/../src/Browser.php';

$browser = new \iamdual\Browser();

// Set output to the specific path
$browser->output(null, __DIR__ . "/downloads")->get("https://placeimg.com/640/480/any");

// Set output to the specific path with custom name
$browser->output("hello.jpg", __DIR__ . "/downloads")->get("https://placeimg.com/640/480/any");