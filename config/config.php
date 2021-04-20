<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default user location
    |--------------------------------------------------------------------------
    |
    | This data will be used by defaults if can not receive location
    | data from service.
    |
    */

    'location' => [
        'default' => [
            'ip' => '127.0.0.1',
            'success' => true,
            'type' => 'IPv4',
            'continent' => 'Europe',
            'continent_code' => 'EU',
            'country' => 'Russia',
            'city' => 'Moscow',
            'country_code' => 'RU',
            'country_capital' => 'Moscow',
            'country_phone' => '+7',
            'region' => 'Rostov Oblast',
            'timezone' => 'Europe/Moscow',
            'timezone_name' => 'Moscow Standard Time',
            'timezone_gmt' => 'GMT +3:00',
            'currency' => 'Russian Ruble',
            'currency_code' => 'RUB',
            'currency_symbol' => '₽',
            'currency_plural' => 'Russian rubles',
        ]
    ]
];
