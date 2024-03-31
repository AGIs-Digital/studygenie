<?php
return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        // Weitere Konfigurationen...
    ],
    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        // Weitere Konfigurationen...
    ],
    // Weitere Einstellungen...
];
?>