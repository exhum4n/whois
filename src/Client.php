<?php

declare(strict_types=1);

namespace Exhum4n\Whois;

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
     * @param string|null $key
     */
    public function __construct(?string $key = null)
    {
        $this->key = $key;
    }

    /**
     * @param string $ip
     *
     * @return Response
     */
    public function get(string $ip): Response
    {
        $url = $this->getServiceUrl($ip);

        $response = $this->makeRequest($url);

        return new Response($response);
    }

    /**
     * @param string $ip
     *
     * @return string
     */
    private function getServiceUrl(string $ip): string
    {
        if (is_null($this->key)) {
            return "{$this->serviceUrl}{$this->freeDZ}/json/{$ip}";
        }

        return "{$this->serviceUrl}{$this->premiumDz}/json/{$ip}?key={$this->key}";
    }

    /**
     * @param string $url
     *
     * @return array
     */
    private function makeRequest(string $url): array
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);

        curl_close($ch);

        return json_decode($json, true);
    }
}
