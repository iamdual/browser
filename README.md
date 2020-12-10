### Browser 🌎
Useful and simple HTTP request class. It can work without curl extension.

**Deprecation notice:** This is an updated version of the library, and the older versions that lower than v1 is now deprecated. If you want to use the older version, check out the branch [v0.1](https://github.com/iamdual/browser/tree/v0.1). 

### Requirements
* PHP 7.2 or above

### Installation
```
composer require iamdual/browser
```

### Usage
```php
use Iamdual\Browser\Client;

$result = Client::create()
                ->referer("https://github.com/iamdual/browser")
                ->post("https://httpbin.org/post", ["foo" => "bar"]);

echo $result->body;
```

### Methods

#### Options
| Name | Description |
|---|---|
| `headers(array $headers)` | Set request headers |
| `header(string $header)` | Append a request header |
| `userAgent(string $ua)` | Set user agent header |
| `contentType(string $type)` | Set content type header |
| `referer(string $referer)` | Set referer URL |
| `cookie(mixed $data)` | Set raw cookie data |
| `timeout(int $timeout)` | Set timeout |
| `proxy(string $address)` | Set proxy |
| `saveAs(string $filename)` | Set output file path |
| `json(mixed $json)` | Set JSON data |
| `maxRedirects(int $number)` | Set max redirects |
| `followLocation(boolean $option)` | Set auto redirect option |
| `insecure(boolean $option)` | Set insecure option |

#### Requests
| Name | Description | Return |
|---|---|---|
| `request(string $method, string $url, mixed $data)` | Send a custom request | Result |
| `get(string $url)` | Send GET request | Result |
| `post(string $url, mixed $data)` | Send POST request | Result |
| `put(string $url, mixed $data)` | Send PUT request | Result |
| `delete(string $url, mixed $data)` | Send DELETE request | Result |
| `patch(string $url, mixed $data)` | Send PATCH request | Result |
| `head(string $url)` | Send HEAD request | Result |
| `options(string $url)` | Send OPTIONS request | Result |

### Properties
After a request, these properties will return from `Result` object.

| Name | Description | Return |
|---|---|---|
| `$body` | Response source | string |
| `$headers` | Response headers | array |
| `$code` | HTTP response code | int |
| `$url` | Response URL | string |
| `$content_type` | Response content type | string |
| `$json`<sup>\[1\]</sup> | Parsed JSON object | mixed |

* \[1\] If `application/json` is the response type, it returns the JSON object, otherwise it's null.
