<?php
/**
 * arrayDaa
 * esta clase conitiene los tipos de contrato y los horarios de trabajo para ser
 * reutilizados de forma sencilla
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'offerContract' => [
        'FCT',
        'Practice',
        'Temporay',
        'Indefinite'
    ],

    "offerWork_Day" => [
        'full day',
        'half day'
    ],
];
