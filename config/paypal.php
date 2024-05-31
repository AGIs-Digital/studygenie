<?php
return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        'app_id' => '',
    ],
    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        'app_id' => '',
    ],
    'payment_action' => 'Sale',
    'currency' => 'EUR',
    'notify_url' => '',
    'locale' => 'de_DE',
    'validate_ssl' => true,
];
?>