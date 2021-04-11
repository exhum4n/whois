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
    private $myDev = 'https://exhum4n.dev/api';

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
     *
     * @throws RequestException
     */
    public function get(string $ip): Response
    {
        $url = $this->getServiceUrl($ip);

        $response = $this->makeRequest($url);

        if ($response['country'] === null) {
            $realIp = $this->getRealIp();

            return $this->get($realIp);
        }

        $response = new Response($response);

        if ($response->success === false) {
            throw new RequestException($response->message);
        }

        return $response;
    }

    /**
     * @return string
     *
     * @throws RequestException
     */
    public function getRealIp(): string
    {
        $response = $this->makeRequest("$this->myDev/ip");

        if (isset($response['ip']) === false) {
            throw new RequestException('Can not receive ip address.');
        }

        return $response['ip'];
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
