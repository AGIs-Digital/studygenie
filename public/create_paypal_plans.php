<?php

// PayPal API Credentials
$clientId = 'Ae9G4SKK4gDuWY0Yw7J_6irXsfPepGSudxvUktzRQlYbdnOKTaDp2xmuC1mCWS6GTvalCH9Owt-HUl4S';
$clientSecret = 'EGnxbz2nF5UZ-zynJxuNXM3w3fFs98fUYO7CF12qkPMXj2LJd5RK-P4CRHk5dcD0LCFiuU-R0xfHY9b-';

// Function to get Access Token
function getAccessToken($clientId, $clientSecret) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);

    $headers = [];
    $headers[] = "Accept: application/json";
    $headers[] = "Accept-Language: en_US";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    $response = json_decode($result, true);
    return $response['access_token'] ?? null;
}

// Function to create a product
function createProduct($accessToken) {
    $productData = [
        "name" => "StudyGenie Abonnement",
        "description" => "StudyGenie Abonnement",
        "type" => "SERVICE",
        "category" => "SOFTWARE"
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/catalogs/products");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($productData));

    $headers = [];
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer " . $accessToken;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    $response = json_decode($result, true);
    return $response['id'] ?? null;
}

// Function to create a plan
function createPlan($accessToken, $productId, $planName, $planDescription, $price) {
    $planData = [
        "product_id" => $productId,
        "name" => $planName,
        "description" => $planDescription,
        "billing_cycles" => [
            [
                "frequency" => [
                    "interval_unit" => "MONTH",
                    "interval_count" => 1
                ],
                "tenure_type" => "REGULAR",
                "sequence" => 1,
                "total_cycles" => 0,
                "pricing_scheme" => [
                    "fixed_price" => [
                        "value" => $price,
                        "currency_code" => "EUR"
                    ]
                ]
            ]
        ],
        "payment_preferences" => [
            "auto_bill_outstanding" => true,
            "setup_fee" => [
                "value" => "0",
                "currency_code" => "EUR"
            ],
            "setup_fee_failure_action" => "CONTINUE",
            "payment_failure_threshold" => 3
        ]
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/billing/plans");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($planData));

    $headers = [];
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer " . $accessToken;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    $response = json_decode($result, true);
    return $response['id'] ?? null;
}

// Main execution
$accessToken = getAccessToken($clientId, $clientSecret);
if ($accessToken) {
    $productId = createProduct($accessToken);
    if ($productId) {
        // Create Gold Plan
        $goldPlanId = createPlan($accessToken, $productId, "Studygenie Gold Abonnement", "Monatliches Gold Abonnement", "10");
        if ($goldPlanId) {
            echo "Gold Plan created successfully. Plan ID: " . $goldPlanId . "\n";
        } else {
            echo "Failed to create Gold plan.\n";
        }

        // Create Diamant Plan
        $diamantPlanId = createPlan($accessToken, $productId, "Studygenie Diamant Abonnement", "Monatliches Diamant Abonnement", "20");
        if ($diamantPlanId) {
            echo "Diamant Plan created successfully. Plan ID: " . $diamantPlanId . "\n";
        } else {
            echo "Failed to create Diamant plan.\n";
        }
    } else {
        echo "Failed to create product.\n";
    }
} else {
    echo "Failed to obtain access token.\n";
}