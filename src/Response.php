<?php

declare(strict_types=1);

namespace Exhum4n\Whois;

class Response
{
    /**
     * IP used for the query (e.g. 8.8.4.4)
     *
     * @var string
     */
    public $ip;

    /**
     * Request status true or false
     *
     * @var bool
     */
    public $success;

    /**
     * included only when success is false
     * Can be one of the following: invalid IP address, you've hit the monthly limit
     *
     * @var string
     */
    public $type;

    /**
     * Continent name (e.g. North America)
     *
     * @var string
     */
    public $continent;

    /**
     * Two-letter continent code (e.g. NA)
     *
     * @var string
     */
    public $continent_code;

    /**
     * Country name (e.g. United States)
     *
     * @var string
     */
    public $country;

    /**
     * Two-letter country code (e.g. US)
     *
     * @var string
     */
    public $country_code;

    /**
     * The capital of country (e.g. Washington)
     *
     * @var string
     */
    public $country_capital;

    /**
     * Country Phone Code (e.g. +1)
     *
     * @var string
     */
    public $country_phone;

    /**
     * Neighboring countries (e.g. CA,MX,CU)
     *
     * @var string
     */
    public $country_neighbours;

    /**
     * Region/state (e.g. Virginia)
     *
     * @var string
     */
    public $region;

    /**
     * City (e.g. Ashburn)
     *
     * @var string
     */
    public $city;

    /**
     * Latitude (e.g. 39.0437567)
     *
     * @var string
     */
    public $latitude;

    /**
     * Longitude (e.g. -77.4874416)
     *
     * @var string
     */
    public $longitude;

    /**
     * AS number (e.g. AS15169)
     *
     * @var string
     */
    public $asn;

    /**
     * Organization name (e.g. Level 3 Communications)
     *
     * @var string
     */
    public $org;

    /**
     * ISP name (e.g. Level 3 Communications)
     *
     * @var string
     */
    public $isp;

    /**
     * City timezone (e.g. America/New_York)
     *
     * @var string
     */
    public $timezone;

    /**
     * Full time zone name (e.g. Eastern Standard Time)
     *
     * @var string
     */
    public $timezone_name;

    /**
     * The offset for daylight-savings time in seconds.
     *
     * @var string
     */
    public $timezone_dstOffset;

    /**
     * The offset from UTC (in seconds) for the given location. (e.g. -18000)
     *
     * @var string
     */
    public $timezone_gmtOffset;

    /**
     * Timezone GMT. (e.g. GMT -5:00)
     *
     * @var string
     */
    public $timezone_gmt;

    /**
     * Country currency name. (e.g. US Dollar)
     *
     * @var string
     */
    public $currency;

    /**
     * Country currency code. (e.g. USD)
     *
     * @var string
     */
    public $currency_code;

    /**
     * Country currency symbol. (e.g. $)
     *
     * @var string
     */
    public $currency_symbol;

    /**
     * The current exchange rate against the US dollar.
     *
     * @var string
     */
    public $currency_rates;

    /**
     * Currency plural. (e.g. US dollars).
     *
     * @var string
     */
    public $currency_plural;

    /**
     * Number of API calls for the current month (Updated every 2 minutes).
     *
     * @var string
     */
    public $completed_requests;

    /**
     * WhoisResponse constructor.
     *
     * @param array $whoisData
     */
    public function __construct(array $whoisData)
    {
        foreach ($whoisData as $key => $value) {
            $key = lcfirst($key);

            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}
