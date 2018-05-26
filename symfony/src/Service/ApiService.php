<?php

namespace App\Service;

/**
 * Get api response for a url.
 */
class ApiService
{
    /**
     * Url Definitions
     *
     * @var array $urlDefinitions urlDefinitions
     */
    private $urlDefinitions;

    /**
     * Constructor
     *
     * @param array $urlDefinitions urlDefinitions
     */
    public function __construct(array $urlDefinitions)
    {
        $this->urlDefinitions = $urlDefinitions;
    }

    /**
     * GetApiResponse - get api response for a url.
     *
     * @param string $urlDefinition url definition
     * @param array  $params        key value query parameters to construct url
     *
     * @return string api response in json format
     */
    public function getApiResponse(string $urlDefinition, array $params = array())
    {
        if (isset($this->urlDefinitions[$urlDefinition])) {
            $url = $this->urlDefinitions[$urlDefinition];
        } else {
            throw \Exception('Invalid url definition');
        }

        foreach ($params as $key => $value) {
            $url = str_replace('{'.$key.'}', urlencode($value), $url);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_PORT, 8983);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
        $result = curl_exec($ch);
        if (false == $result) {
            throw new \Exception('curl error'.$ch);
        }
        curl_close($ch);

        return json_decode($result, true);
    }
}
