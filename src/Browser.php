<?php
/*
 * Copyright 2020, Ekin Karadeniz <imduual@gmail.com>
 *
 * Documentation:
 * https://github.com/iamdual/browser
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace iamdual;

class Browser
{

    /**
     * @var void
     */
    private $curl = null;

    /**
     * @var string
     */
    private $request_url = null;

    /**
     * @var mixed
     */
    private $request_data = null;

    /**
     * @var string
     */
    private $request_method = null;

    /**
     * @var array
     */
    private $request_headers = array();

    /**
     * @var string
     */
    private $request_referer = null;

    /**
     * @var string
     */
    private $request_user_agent = "Browser/0.1 (http://github.com/iamdual/browser)";

    /**
     * @var int
     */
    private $request_timeout = null;

    /**
     * @var boolean
     */
    private $request_auto_redirect = true;

    /**
     * @var boolean
     */
    private $request_insecure = false;

    /**
     * @var array
     */
    private $request_http_auth = array();

    /**
     * @var boolean
     */
    private $request_cookies_enabled = false;

    /**
     * @var string
     */
    private $request_cookie_file = null;

    /**
     * @var string
     */
    private $request_cookie_data = null;

    /**
     * @var string
     */
    private $request_cert_file = null;

    /**
     * @var string
     */
    private $request_proxy_address = null;

    /**
     * @var array
     */
    private $request_proxy_auth = array();

    /**
     * @var int
     */
    private $request_proxy_type = null;

    /**
     * @var array
     */
    private $request_options = array();

    /**
     * @var string
     */
    private $request_output_path = null;

    /**
     * @var string
     */
    private $request_output_filename = null;

    /**
     * Response headers
     * @var array
     */
    public $headers = array();

    /**
     * The response source
     * @var string
     */
    public $source = null;

    /**
     * The JSON object if response is JSON
     * @var object
     */
    public $json = null;

    /**
     * The response code
     * @var int
     */
    public $code = null;

    /**
     * The response content type
     * @var string
     */
    public $content_type = null;

    /**
     * The response url
     * @var int
     */
    public $url = null;

    /**
     * Total request time (seconds)
     * @var double
     */
    public $total_time = null;

    /**
     * The curl info
     * @var array
     */
    public $info = array();

    /**
     * The curl error
     * @var string
     */
    public $error = null;

    /**
     * Setting default request variables
     * @param array $defaults (optional)
     * @return $this
     */
    function __construct($defaults = null)
    {
        if ($defaults !== null) {
            foreach ($defaults as $key => $value) {
                $this->{'request_' . $key} = $value;
            }
        }

        $this->curl = curl_init();
        return $this;
    }

    /**
     * Custom request
     * @param $method string
     * @param $url string
     * @param $data mixed (optional)
     * @return string
     */
    public function request($method, $url, $data = null)
    {
        $this->request_method = $method;
        $this->request_url = $url;
        $this->request_data = $data;
        return $this->execute();
    }

    /**
     * GET request
     * @param $url string
     * @return string
     */
    public function get($url)
    {
        $this->request_method = "GET";
        $this->request_url = $url;
        $this->request_data = null;
        return $this->execute();
    }

    /**
     * POST request
     * @param $url string
     * @param $data mixed (optional)
     * @return string
     */
    public function post($url, $data = null)
    {
        $this->request_method = "POST";
        $this->request_url = $url;
        $this->request_data = $data;
        return $this->execute();
    }

    /**
     * PUT request
     * @param $url string
     * @param $data mixed (optional)
     * @return string
     */
    public function put($url, $data = null)
    {
        $this->request_method = "PUT";
        $this->request_url = $url;
        $this->request_data = $data;
        return $this->execute();
    }

    /**
     * DELETE request
     * @param $url string
     * @param $data mixed (optional)
     * @return string
     */
    public function delete($url, $data = null)
    {
        $this->request_method = "DELETE";
        $this->request_url = $url;
        $this->request_data = $data;
        return $this->execute();
    }

    /**
     * PATCH request
     * @param $url string
     * @param $data mixed (optional)
     * @return string
     */
    public function patch($url, $data = null)
    {
        $this->request_method = "PATCH";
        $this->request_url = $url;
        $this->request_data = $data;
        return $this->execute();
    }

    /**
     * Set JSON data
     * @param $data mixed
     * @return $this
     */
    public function json_data($data)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        $this->set_opt(CURLOPT_POSTFIELDS, $data);
        $this->header("Content-Type: application/json");
        $this->header("Content-Length: " . strlen($data));
        return $this;
    }

    /**
     * Set request headers
     * @param $headers array
     * @return $this
     */
    public function headers($headers)
    {
        $this->request_headers = $headers;
        return $this;
    }

    /**
     * Append a request header
     * @param $header string
     * @return $this
     */
    public function header($header)
    {
        $this->request_headers[] = $header;
        return $this;
    }

    /**
     * Set referer URL
     * @param $referer string
     * @return $this
     */
    public function referer($referer)
    {
        $this->request_referer = $referer;
        return $this;
    }

    /**
     * Set user agent
     * @param $user_agent string
     * @return $this
     */
    public function user_agent($user_agent)
    {
        $this->request_user_agent = $user_agent;
        return $this;
    }

    /**
     * Set timeout (seconds)
     * @param $timeout int
     * @return $this
     */
    public function timeout($timeout)
    {
        $this->request_timeout = $timeout;
        return $this;
    }

    /**
     * Set auto redirect option
     * @param $option boolean
     * @return $this
     */
    public function auto_redirect($option = true)
    {
        $this->request_auto_redirect = $option;
        return $this;
    }

    /**
     * Set insecure option
     * @param $option boolean
     * @return $this
     */
    public function insecure($option = false)
    {
        $this->request_insecure = $option;
        return $this;
    }

    /**
     * Set HTTP auth credentials
     * @param $username string
     * @param $password string
     * @return $this
     */
    public function http_auth($username, $password)
    {
        $this->request_http_auth = array($username, $password);
        return $this;
    }

    /**
     * Set cookies enabled
     * @param $option boolean
     * @return $this
     */
    public function cookies_enabled($option = true)
    {
        $this->request_cookies_enabled = $option;
        return $this;
    }

    /**
     * Set cookie file
     * @param $filename string
     * @return $this
     */
    public function cookie_file($filename)
    {
        $this->request_cookie_file = $filename;
        return $this;
    }

    /**
     * Set cookie data
     * @param $data mixed
     * @return $this
     */
    public function cookie($data)
    {
        $this->request_cookie_data = $data;
        return $this;
    }

    /**
     * Set certificate file
     * @param $filename string
     * @return $this
     */
    public function cert_file($filename)
    {
        $this->request_cert_file = $filename;
        return $this;
    }

    /**
     * Set proxy address and/or auth credentials
     * @param $address string
     * @param $username string (optional)
     * @param $password string (optional)
     * @param $type int (optional)
     * @return $this
     */
    public function proxy($address, $username = null, $password = null, $type = null)
    {
        $this->request_proxy_address = $address;
        if ($username) {
            $this->request_proxy_auth = array($username, $password);
        }
        if ($type) {
            $this->request_proxy_type = $type;
        }
        return $this;
    }

    /**
     * Set the output to a file
     * @param $path string
     * @param $filename string (Optional)
     * @return $this
     */
    public function output($path, $filename = null)
    {
        $this->request_output_path = $path;
        $this->request_output_filename = $filename;
        return $this;
    }

    /**
     * Set custom curl option
     * @param $key int
     * @param $value mixed
     * @return $this
     */
    public function set_opt($key, $value)
    {
        $this->request_options[$key] = $value;
        return $this;
    }

    /**
     * Execute the curl
     * @return string
     */
    private function execute()
    {
        if (!$this->request_url) {
            return null;
        }

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_URL, $this->request_url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $this->request_method);

        if ($this->request_insecure === true) {
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->curl, CURLOPT_CAINFO, false);
        } else {
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYHOST, 2);
            if ($this->request_cert_file === null) {
                $this->request_cert_file = __DIR__ . "/ca-bundle.crt";
            }
            curl_setopt($this->curl, CURLOPT_CAINFO, $this->request_cert_file);
        }

        if ($this->request_data) {
            if (is_array($this->request_data)) {
                $this->request_data = http_build_query($this->request_data);
            }
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->request_data);
        }

        if ($this->request_headers) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->request_headers);
        }

        if ($this->request_cookies_enabled) {
            if ($this->request_cookie_file === null) {
                $this->request_cookie_file = sys_get_temp_dir() . "/browser-cookies.txt";
            }
            curl_setopt($this->curl, CURLOPT_COOKIESESSION, true);
            curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->request_cookie_file);
            curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->request_cookie_file);
        }

        if ($this->request_cookie_data) {
            if (is_array($this->request_cookie_data)) {
                $this->request_cookie_data = http_build_query($this->request_cookie_data, "", ";");
            }
            curl_setopt($this->curl, CURLOPT_COOKIE, $this->request_cookie_data);
        }

        if ($this->request_user_agent) {
            curl_setopt($this->curl, CURLOPT_USERAGENT, $this->request_user_agent);
        }

        if ($this->request_auto_redirect) {
            curl_setopt($this->curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        }

        if ($this->request_referer) {
            curl_setopt($this->curl, CURLOPT_REFERER, $this->request_referer);
        }

        if ($this->request_timeout) {
            curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->request_timeout);
        }

        if ($this->request_http_auth && is_array($this->request_http_auth)) {
            curl_setopt($this->curl, CURLOPT_USERPWD, implode(":", $this->request_http_auth));
        }

        if ($this->request_proxy_address) {
            curl_setopt($this->curl, CURLOPT_PROXY, $this->request_proxy_address);
            if ($this->request_proxy_auth && is_array($this->request_proxy_auth)) {
                curl_setopt($this->curl, CURLOPT_PROXYUSERPWD, implode(":", $this->request_proxy_auth));
            }
            if ($this->request_proxy_type) {
                curl_setopt($this->curl, CURLOPT_PROXYTYPE, $this->request_proxy_type);
            }
        }

        if ($this->request_output_path) {
            if (!$this->request_output_filename) {
                $this->request_output_filename = basename($this->request_url);
            }
            $fp = fopen($this->request_output_path . "/" . $this->request_output_filename, "w+");
            curl_setopt($this->curl, CURLOPT_FILE, $fp);
        }

        if ($this->request_options) {
            foreach ($this->request_options as $key => $value) {
                curl_setopt($this->curl, $key, $value);
            }
        }

        curl_setopt($this->curl, CURLOPT_HEADERFUNCTION,
            function($curl, $header_line) {
                $header = explode(":", $header_line, 2);
                if (isset($header[1])) {
                    $this->headers[trim($header[0])] = trim($header[1]);
                }
                return strlen($header_line);
            }
        );

        $this->source = curl_exec($this->curl);
        $this->info = curl_getinfo($this->curl);

        $this->code = $this->info["http_code"];
        $this->content_type = $this->info["content_type"];
        $this->url = $this->info["url"];
        $this->total_time = $this->info["total_time"];

        if (strcasecmp($this->content_type, "application/json") == 0) {
            $this->json = json_decode($this->source);
        }

        if (isset($fp)) {
            fclose($fp);
        }

        if (curl_errno($this->curl)) {
            $this->error = curl_error($this->curl);
        }

        return $this->source;
    }

    function __destruct()
    {
        curl_close($this->curl);
    }
}
