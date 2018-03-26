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

    'zendesk' => array(
        'subdomain' => env('ZENDESK_subdomain'),
        'username' => env('ZENDESK_USERNAME'),
        'token' => env('ZENDESK_TOKEN'),
    ),

    'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID', '1925384864154472'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET', '2019b352eb26df8dc70590dae3580d17'),
    'redirect' => env('FACEBOOK_CALLBACK_URL', 'http://damp-lake-32602.herokuapp.com/auth/facebook/callback'),
    ],

    'twitter' => [
    'client_id' => env('TWITTER_CLIENT_ID', 'ofpNm2u3CeQdyGOmiwhXmNuGQ'),
    'client_secret' => env('TWITTER_CLIENT_SECRET', '98mGWRNWZl75Zcvbv9ao0wI98M4BbPkRgeBazMN9IzYfQ7ye4n'),
    'redirect' => env('TWITTER_CALLBACK_URL', 'http://damp-lake-32602.herokuapp.com/auth/twitter/callback'),
    ],

    'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID', '939610946624-8sckc4a0nl9p0nj8paof3ho1rekmqf1u.apps.googleusercontent.com'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET', 'JP1zJ76TobkEdFGiTowlf_RB'),
    'redirect' => env('GOOGLE_CALLBACK_URL', 'http://damp-lake-32602.herokuapp.com/auth/google/callback'),
    ],

    
];
