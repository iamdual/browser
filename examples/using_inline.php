<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

echo (new Browser())->user_agent("Foo Browser/1.0")->get("https://httpbin.org/get");