<?php namespace Iamdual\Browser\Provider;

use Iamdual\Browser\Exception\InvalidParameterException;
use Iamdual\Browser\Exception\ProviderErrorException;
use Iamdual\Browser\Result;

class Curl extends Provider
{
    /**
     * @return Result|null
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    protected function execute(): ?Result
    {
        parent::execute();

        $this->result = new Result();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $this->request_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->request_method);

        if ($this->request_content_type) {
            $this->header("Content-Type: " . $this->request_content_type);
        }

        if ($this->request_data) {
            if (is_array($this->request_data)) {
                $this->request_data = http_build_query($this->request_data);
            }
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->request_data);
        }

        if ($this->request_cookie_data) {
            if (is_array($this->request_cookie_data)) {
                $this->request_cookie_data = http_build_query($this->request_cookie_data, "", ";");
            }
            curl_setopt($curl, CURLOPT_COOKIE, $this->request_cookie_data);
        }

        if ($this->request_user_agent) {
            curl_setopt($curl, CURLOPT_USERAGENT, $this->request_user_agent);
        }

        if ($this->request_referer) {
            curl_setopt($curl, CURLOPT_REFERER, $this->request_referer);
        }

        if ($this->request_headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->request_headers);
        }

        if ($this->request_max_redirects) {
            curl_setopt($curl, CURLOPT_MAXREDIRS, $this->request_max_redirects);
        }

        if ($this->request_follow_location) {
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        }

        if ($this->request_timeout) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->request_timeout);
        }

        if ($this->request_proxy) {
            curl_setopt($curl, CURLOPT_PROXY, $this->request_proxy);
            if ($this->request_proxy_auth && is_array($this->request_proxy_auth)) {
                curl_setopt($curl, CURLOPT_PROXYUSERPWD, implode(":", $this->request_proxy_auth));
            }
            if ($this->request_proxy_type) {
                curl_setopt($curl, CURLOPT_PROXYTYPE, $this->request_proxy_type);
            }
        }

        if ($this->request_insecure === true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }

        if ($this->request_save_as) {
            $fp = fopen($this->request_save_as, "w+");
            curl_setopt($curl, CURLOPT_FILE, $fp);
        }

        curl_setopt($curl, CURLOPT_HEADERFUNCTION,
            function ($curl, $header_line) {
                $header = explode(":", $header_line, 2);
                if (isset($header[1])) {
                    $header_key = strtolower(trim($header[0]));
                    $header_val = trim($header[1]);

                    if ($header_key === "content-type") {
                        $header_val = explode(";", $header_val, 2);
                        $header_val = trim($header_val[0]);
                        $this->result->content_type = $header_val;
                    }

                    $this->result->headers[$header_key] = $header_val;
                }
                return strlen($header_line);
            }
        );

        $this->result->body = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new ProviderErrorException(curl_error($curl));
        }

        $curl_info = curl_getinfo($curl);
        $this->result->code = $curl_info["http_code"];
        if (!$this->result->content_type) {
            $this->result->content_type = $curl_info["content_type"];
        }
        $this->result->url = $curl_info["url"];

        if (strcasecmp($this->result->content_type, "application/json") == 0) {
            $this->result->json = json_decode($this->result->body);
        }

        if (isset($fp)) {
            fclose($fp);
        }

        curl_close($curl);
        return $this->result;
    }
}