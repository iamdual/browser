<?php namespace Iamdual\Browser\Provider;

use Iamdual\Browser\Exception\InvalidParameterException;
use Iamdual\Browser\Exception\ProviderErrorException;
use Iamdual\Browser\Result;

class Native extends Provider
{
    /**
     * @return Result
     * @throws InvalidParameterException
     * @throws ProviderErrorException
     */
    protected function execute()
    {
        parent::execute();

        $this->result = new Result();

        $http_params = [];
        $http_params["method"] = $this->request_method;

        if ($this->request_content_type) {
            $this->header("Content-Type: " . $this->request_content_type);
        }

        if ($this->request_data) {
            if (is_array($this->request_data)) {
                $this->request_data = http_build_query($this->request_data);
            }
            $http_params["content"] = $this->request_data;

            if (!$this->request_content_type) {
                $this->header("Content-Type: application/x-www-form-urlencoded");
            }
            $this->header("Content-Length: " . strlen($this->request_data));
        }

        if ($this->request_cookie_data) {
            if (is_array($this->request_cookie_data)) {
                $this->request_cookie_data = http_build_query($this->request_cookie_data, "", ";");
            }
            $this->header("Cookie: " . $this->request_cookie_data);
        }

        if ($this->request_user_agent) {
            $this->header("User-Agent: " . $this->request_user_agent);
        }

        if ($this->request_referer) {
            $this->header("Referer: " . $this->request_referer);
        }

        if ($this->request_headers) {
            $http_params["header"] = implode("\r\n", $this->request_headers);
        }

        if ($this->request_follow_location) {
            $http_params["follow_location"] = 1;
        }

        if ($this->request_timeout) {
            $http_params["timeout"] = $this->request_timeout;
        }

        $context = stream_context_create([
            "http" => $http_params,
        ]);

        $this->result->body = file_get_contents($this->request_url, false, $context);
        if ($this->result->body === false) {
            if ($error = error_get_last() && isset($error["message"])) {
                throw new ProviderErrorException($error["message"]);
            }
        }

        if (is_array($http_response_header) && isset($http_response_header[0])) {
            $this->result->code = (int)substr($http_response_header[0], 9, 3);

            foreach ($http_response_header as $line) {
                $header = explode(":", $line, 2);
                if (isset($header[1])) {
                    $header_key = strtolower(trim($header[0]));
                    $header_val = trim($header[1]);
                    $this->result->headers[$header_key] = $header_val;

                    if ($header_key === "content-type") {
                        $header_val = explode(";", $header_val, 2);
                        $this->result->content_type = trim($header_val[0]);
                    }
                }
            }
        }

        $this->result->url = $this->request_url;

        if (strcasecmp($this->result->content_type, "application/json") == 0) {
            $this->result->json = json_decode($this->result->body);
        }

        return $this->result;
    }
}