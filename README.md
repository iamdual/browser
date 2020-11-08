### Browser 🌎
Featured and simple HTTP request class for PHP 5.4+

### Installing
```
composer require iamdual/browser
```

### Examples
GET request

```php
$browser = new \iamdual\Browser();
echo $browser->get("https://httpbin.org/get");
```

POST request

```php
$browser = new \iamdual\Browser();
echo $browser->post("https://httpbin.org/post", array("foo" => "bar"));
```

POST JSON data

```php
$browser = new \iamdual\Browser();
$browser->json_data(array("foo" => "bar"));
echo $browser->post("https://httpbin.org/post");
```

PUT request

```php
$browser = new \iamdual\Browser();
echo $browser->put("https://httpbin.org/put", array("foo" => "bar"));
```

Response code

```php
$browser = new \iamdual\Browser();
$browser->get("https://httpbin.org/get");
echo $browser->code;
```

Set defaults
```php
$defaults = array(
    "user_agent" => "Foo Bar Browser/1.0",
    "referer" => "https://github.com/iamdual/browser"
);
$browser = new Browser($defaults);
echo $browser->get("https://httpbin.org/get");
```

More examples in the "[examples](/examples)" directory.

### Methods
| Name | Description |
|---|---|
| `referer(string $referer)` | Set referer URL |
| `user_agent(string $user_agent)` | Set user agent |
| `timeout(int $timeout)` | Set timeout |
| `headers(array $headers)` | Set request headers |
| `header(string $header)` | Append a request header |
| `http_auth(string $username, string $password)` | Set HTTP auth credentials |
| `cookies_enabled(boolean $option)` | Set cookies enabled option |
| `cookie_file(string $filename)` | Set cookie filename |
| `cookie(mixed $data)` | Set raw cookie data |
| `cert_file(string $filename)` | Set certificate file |
| `proxy(string $address, string $username, string $password)` | Set proxy address and/or auth credentials |
| `set_opt(int $key, mixed $value)` | Set custom curl option |
| `json_data(mixed $data)` | Set JSON data |
| `auto_redirect(boolean $option)` | Set auto redirect option (default: true) |
| `insecure(boolean $option)` | Set insecure option (default: false) |

| Name | Description | Return |
|---|---|---|
| `get(string $url)` | Send GET request | string |
| `post(string $url, mixed $data)` | Send POST request | string |
| `put(string $url, mixed $data)` | Send PUT request | string |
| `delete(string $url, mixed $data)` | Send DELETE request | string |
| `patch(string $url, mixed $data)` | Send PATCH request | string |

### Variables
| Name | Description | Return |
|---|---|---|
| `$code` | HTTP response code | int |
| `$content_type` | Response content type | string |
| `$url` | Response URL | string |
| `$headers` | Response headers | array |
| `$source` | Response source | string |
| `$json` | Parsed JSON object | object |
| `$total_time` | Total request time | int |
| `$info` | Response info | array |
| `$error` | Response error | string |

### Notes
The [`curl extension`](https://php.net/manual/en/book.curl.php) must be installed on the server.

### Contributes
Please send pull request or open an issue if you have the feature you want.
