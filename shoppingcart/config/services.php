<?php

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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '355243024843814',
        'client_secret' => '2bd20f40c1a98226c1172a3aab55a91a',
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'K1HKLAkjVNPUU95dQ4hNvCiGo',
        'client_secret' => 'UwsbhyCT6AEkMF6MTARtOkRX7rhohyDK2ac6PZmV5605WTAnAP',
        'redirect' => 'http://localhost:8000/twitter/callback',
    ],

    'google' => [
        'client_id' => '1052111097208-f4fiai3n3hgo71q967qc706clnk3n2j2.apps.googleusercontent.com',
        'client_secret' => 'BmqegWvqLj3xlNO-UeI3tBuU',
        'redirect' => 'http://localhost:8000/google/callback',
    ],

];
