<?php
require __DIR__ . '/../src/Browser.php';

use \iamdual\Browser;

$defaults = array(
    "user_agent" => "Foo Bar Browser/1.0",
    "referer" => "https://github.com/iamdual/browser",
    "timeout" => 2,
    "headers" => array("Foo: Bar", "Drink: Beer"),
    "auto_redirect" => true,
    "http_auth" => array("username", "password"),
    "cookies_enabled" => false,
    "cookie_file" => "browser.txt",
    "cookie_data" => "foo=bar;iam=dual",
    "cert_file" => "example.crt",
    "proxy_address" => "http://127.0.0.1:8080",
    "proxy_auth" => array("username", "password")
);

$browser = new Browser($defaults);
echo $browser->post("https://httpbin.org/post");