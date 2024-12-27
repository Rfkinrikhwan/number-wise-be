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

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Semua metode HTTP diizinkan

    'allowed_origins' => ['*'], // Semua asal (domain) diizinkan
    // 'allowed_origins' => ['http://example.com', 'https://another-domain.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Semua header diizinkan
    // 'allowed_headers' => ['Content-Type', 'X-Requested-With'],

    'exposed_headers' => [],

    'max_age' => 0, // Maksimal waktu cache preflight

    'supports_credentials' => false, // Apakah cookie/credential diizinkan
];
