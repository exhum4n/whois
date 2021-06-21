<?php

declare(strict_types=1);

namespace Exhum4n\Whois;

use Exhum4n\Whois\Exceptions\RequestException;

class Client
{
    /**
     * @var string
     */
    private $serviceUrl = 'http://ipwhois.';

    /**
     * @var string
     */
    private $premiumDz = 'pro';

    /**
     * @var string
     */
    private $freeDZ = 'app';

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $locale;

    /**
     * @param string|null $key
     * @param string|null $locale
     */
    public function __construct(?string $key = null, ?string $locale = null)
    {
        $this->key = $key;
        $this->locale = $locale ?: 'en';
    }

    /**
     * @param string $ip
     *
     * @return Response
     *
     * @throws RequestException
     */
    public function get(string $ip): Response
    {
        $url = $this->getServiceUrl($ip);

        $response = $this->makeRequest($url);
        if (is_null($response)) {
            throw new RequestException('Can not connect to whois service.');
        }

        $response = new Response($response);

        if ($response->success === false) {
            throw new RequestException($response->message);
        }

        return $response;
    }

    /**
     * @param string $ip
     *
     * @return string
     */
    private function getServiceUrl(string $ip): string
    {
        if (is_null($this->key)) {
            return "{$this->serviceUrl}{$this->freeDZ}/json/{$ip}?lang={$this->locale}";
        }

        return "{$this->serviceUrl}{$this->premiumDz}/json/{$ip}?lang={$this->locale}&key={$this->key}";
    }

    /**
     * @param string $url
     *
     * @return array|null
     */
    private function makeRequest(string $url): ?array
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);

        curl_close($ch);

        return json_decode($json, true);
    }
}
