<?php namespace Iamdual\Browser;

use Iamdual\Browser\Exception\ProviderNotFoundException;
use Iamdual\Browser\Provider\Native;
use Iamdual\Browser\Provider\Curl;

class Client
{
    const PROVIDER_NATIVE = 'Native';
    const PROVIDER_CURL = 'Curl';

    /**
     * @param array $defaults
     * @param null $provider
     * @return Curl|Native
     * @throws ProviderNotFoundException
     */
    public static function create($defaults = [], $provider = null)
    {
        if ($provider === null) {
            if (is_callable('curl_init')) {
                $provider = self::PROVIDER_CURL;
            } else {
                $provider = self::PROVIDER_NATIVE;
            }
        }

        switch ($provider) {
            case self::PROVIDER_NATIVE:
                return new Native($defaults);
            case self::PROVIDER_CURL:
                return new Curl($defaults);
            default:
                throw new ProviderNotFoundException(
                    sprintf('Provider "%s" not found.', $provider)
                );
        }
    }
}