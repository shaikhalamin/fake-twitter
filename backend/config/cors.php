<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*', 'v1/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['https://vuejs-twitter-frontend.vercel.app', 'http://localhost:8080', 'http://localhost:7890'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Origin', 'X-Requested-With', 'Content-Type', 'X-CSRF-TOKEN', 'Refreshtoken', 'Access-Control-Allow-Headers', 'Access-Control-Request-Method', 'x-csrf-token', 'Access-Control-Request-Headers', 'X-Requested-With', 'Authorization',
        'Accept', 'Authorization', 'Referer', 'Sec-Ch-Ua', 'Sec-Ch-Ua-Platform', 'User-Agent'
    ],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
