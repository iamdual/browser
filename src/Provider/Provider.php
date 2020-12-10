<?php namespace Iamdual\Browser\Provider;

use Iamdual\Browser\Exception\InvalidParameterException;
use Iamdual\Browser\Exception\ProviderErrorException;
use Iamdual\Browser\Result;

abstract class Provider
{
    const METHOD_GET = "GET";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_DELETE = "DELETE";
    const METHOD_PATCH = "PATCH";
    const METHOD_HEAD = "HEAD";
    const METHOD_OPTIONS = "OPTIONS";

    /**
     * @var string
     */
    protected $request_url = null;

    /**
     * @var string
     */
    protected $request_method = self::METHOD_GET;

    /**
     * @var mixed
     */
    protected $request_data = null;

    /**
     * @var array
     */
    protected $request_headers = [];

    /**
     * @var string
     */
    protected $request_user_agent = "Browser/1.0 (http://github.com/iamdual/browser)";

    /**
     * @var string
     */
    protected $request_content_type = null;

    /**
     * @var string
     */
    protected $request_referer = null;

    /**
     * @var mixed
     */
    protected $request_cookie_data = null;

    /**
     * @var float
     */
    protected $request_timeout = 10.0;

    /**
     * @var string
     */
    protected $request_proxy = null;

    /**
     * @var mixed
     */
    protected $request_proxy_auth = null;

    /**
     * @var mixed
     */
    protected $request_proxy_type = null;

    /**
     * @var string
     */
    protected $request_save_as = null;

    /**
     * @var int
     */
    protected $request_max_redirects = 0;

    /**
     * @var bool
     */
    protected $request_follow_location = true;

    /**
     * @var bool
     */
    protected $request_insecure = false;

    /**
     * @var Result
     */
    protected $result = null;

    /**
     * @param array $defaults (optional)
     */
    public function __construct($defaults = [])
    {
        if (!empty($defaults)) {
            foreach ($defaults as $key => $val) {
                $this->{"request_" . $key} = $val;
            }
        }
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function headers(array $headers)
    {
        $this->request_headers = $headers;
        return $this;
    }

    /**
     * @param string $header
     * @return $this
     */
    public function header(string $header)
    {
        $this->request_headers[] = $header;
        return $this;
    }

    /**
     * @param string $ua
     * @return $this
     */
    public function userAgent(string $ua)
    {
        $this->request_user_agent = $ua;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function contentType(string $type)
    {
        $this->request_content_type = $type;
        return $this;
    }

    /**
     * @param string $referer
     * @return $this
     */
    public function referer(string $referer)
    {
        $this->request_referer = $referer;
        return $this;
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function cookie($data)
    {
        $this->request_cookie_data = $data;
        return $this;
    }

    /**
     * @param float $timeout
     * @return $this
     */
    public function timeout(float $timeout)
    {
        $this->request_timeout = $timeout;
        return $this;
    }

    /**
     * @param string $address
     * @param mixed $auth (optional)
     * @param mixed $type (optional)
     * @return $this
     */
    public function proxy(string $address, $auth = null, $type = null)
    {
        $this->request_proxy = $address;
        $this->request_proxy_auth = $auth;
        $this->request_proxy_type = $type;
        return $this;
    }

    /**
     * @param string $filename
     * @return $this
     */
    public function saveAs(string $filename)
    {
        $this->request_save_as = $filename;
        return $this;
    }

    /**
     * @param mixed $json
     * @return $this
     */
    public function json($json)
    {
        if (is_array($json)) {
            $json = json_encode($json);
        }
        $this->request_data = $json;
        $this->contentType("application/json");
        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function maxRedirects(int $number)
    {
        $this->request_max_redirects = $number;
        return $this;
    }

    /**
     * @param bool $option
     * @return $this
     */
    public function followLocation($option = true)
    {
        $this->request_follow_location = $option;
        return $this;
    }

    /**
     * @param bool $option
     * @return $this
     */
    public function insecure($option = true)
    {
        $this->request_insecure = $option;
        return $this;
    }

    /**
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    protected function execute(): ?Result
    {
        if (!$this->request_url) {
            throw new InvalidParameterException("No request URL entered.");
        }

        return null;
    }

    /**
     * @param string $method
     * @param string $url
     * @param mixed $data
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function request(string $method, string $url, $data = null): ?Result
    {
        $this->request_method = $method;
        $this->request_url = $url;
        if ($data !== null) {
            $this->request_data = $data;
        }
        return $this->execute();
    }

    /**
     * @param string $url
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function get(string $url): ?Result
    {
        return $this->request(self::METHOD_GET, $url);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function post(string $url, $data = null): ?Result
    {
        return $this->request(self::METHOD_POST, $url, $data);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function put(string $url, $data = null): ?Result
    {
        return $this->request(self::METHOD_PUT, $url, $data);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function delete(string $url, $data = null): ?Result
    {
        return $this->request(self::METHOD_DELETE, $url, $data);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function patch(string $url, $data = null): ?Result
    {
        return $this->request(self::METHOD_PATCH, $url, $data);
    }

    /**
     * @param string $url
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function head(string $url): ?Result
    {
        return $this->request(self::METHOD_HEAD, $url);
    }

    /**
     * @param string $url
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    public function options(string $url): ?Result
    {
        return $this->request(self::METHOD_OPTIONS, $url);
    }
}