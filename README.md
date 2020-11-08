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

#### Options
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
| `auto_redirect(boolean $option)` | Set auto redirect option |
| `insecure(boolean $option)` | Set insecure option |

#### Requests
After a request, these properties will return needed values.

| Name | Description | Return |
|---|---|---|
| `request(string $method, string $url, mixed $data)` | Send a custom request | string |
| `get(string $url)` | Send GET request | string |
| `post(string $url, mixed $data)` | Send POST request | string |
| `put(string $url, mixed $data)` | Send PUT request | string |
| `delete(string $url, mixed $data)` | Send DELETE request | string |
| `patch(string $url, mixed $data)` | Send PATCH request | string |

### Properties
| Name | Description | Return |
|---|---|---|
| `$code` | HTTP response code | int |
| `$content_type` | Response content type | string |
| `$headers` | Response headers | array |
| `$source` | Response source | string |
| `$url` | Response URL | string |
| `$info` | Response info | array |
| `$error`<sup>\[1\]</sup> | Response error | mixed |
| `$total_time` | Total request time | int |
| `$json`<sup>\[2\]</sup> | Parsed JSON object | mixed |


* \[1\] It returns the error description in string, otherwise it's null.
* \[2\] If `application/json` is the response type, it returns the JSON object, otherwise it's null.

### Notes
The [`curl extension`](https://php.net/manual/en/book.curl.php) must be installed on the server.

### Contributes
Please send pull request or open an issue if you have the feature you want.
