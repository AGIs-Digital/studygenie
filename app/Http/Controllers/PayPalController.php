<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    public function setupPlans()
    {
        // Erstelle ein Produkt
        $response = Http::withBasicAuth('Abj-J9HxV5L4s1izmSlNl27AJLM0z71Z0BzLAVV4n7ClCYaxlBWEGdvfSBnSvY7beu-AhQv0YdMLOzcc', 'EP3Uw3x4sZqIuOAEtSKeUW3rKzVKjm4myz5Wt5IVZDpHjBberd-9CKPC_1l9gsQh7Rsx4Zc8-d8dNSDJ')
            ->post('https://api-m.sandbox.paypal.com/v1/catalogs/products', [
                'name' => 'StudyGenie Subscription',
                'description' => 'Subscription for StudyGenie services',
                'type' => 'SERVICE',
                'category' => 'SOFTWARE'
            ]);

        $product = $response->json();

        if (!isset($product['id'])) {
            Log::error('PayPal createProduct response error: ', $product);
            return response()->json(['error' => 'Failed to create product'], 500);
        }

        $productId = $product['id'];
        Log::info('PayPal createProduct response: ', $product);

        // Erstelle den Gold-Plan
        $responseGold = Http::withBasicAuth('Abj-J9HxV5L4s1izmSlNl27AJLM0z71Z0BzLAVV4n7ClCYaxlBWEGdvfSBnSvY7beu-AhQv0YdMLOzcc', 'EP3Uw3x4sZqIuOAEtSKeUW3rKzVKjm4myz5Wt5IVZDpHjBberd-9CKPC_1l9gsQh7Rsx4Zc8-d8dNSDJ')
            ->post('https://api-m.sandbox.paypal.com/v1/billing/plans', [
                'product_id' => $productId,
                'name' => 'Gold Abonnement',
                'description' => 'Monatliches Gold Abonnement: Textinspirationen, Textanalyse, Bewerbungsunterlagen',
                'billing_cycles' => [
                    [
                        'frequency' => [
                            'interval_unit' => 'MONTH',
                            'interval_count' => 1
                        ],
                        'tenure_type' => 'REGULAR',
                        'sequence' => 1,
                        'total_cycles' => 0,
                        'pricing_scheme' => [
                            'fixed_price' => [
                                'value' => '10.00',
                                'currency_code' => 'EUR'
                            ]
                        ]
                    ]
                ],
                'payment_preferences' => [
                    'auto_bill_outstanding' => true,
                    'setup_fee' => [
                        'value' => '0',
                        'currency_code' => 'EUR'
                    ],
                    'setup_fee_failure_action' => 'CONTINUE',
                    'payment_failure_threshold' => 3
                ]
            ]);

        $planGold = $responseGold->json();

        if (!isset($planGold['id'])) {
            Log::error('PayPal createPlan (Gold) response error: ', $planGold);
            return response()->json(['error' => 'Failed to create Gold plan'], 500);
        }

        $planGoldId = $planGold['id'];
        Log::info('PayPal createPlan (Gold) response: ', $planGold);

        // Erstelle den Diamant-Plan
        $responseDiamant = Http::withBasicAuth('Abj-J9HxV5L4s1izmSlNl27AJLM0z71Z0BzLAVV4n7ClCYaxlBWEGdvfSBnSvY7beu-AhQv0YdMLOzcc', 'EP3Uw3x4sZqIuOAEtSKeUW3rKzVKjm4myz5Wt5IVZDpHjBberd-9CKPC_1l9gsQh7Rsx4Zc8-d8dNSDJ')
            ->post('https://api-m.sandbox.paypal.com/v1/billing/plans', [
                'product_id' => $productId,
                'name' => 'Diamant Abonnement',
                'description' => 'Monatliches Diamant Abonnement: Textinspirationen, Textanalyse, Bewerbungsunterlagen, Lerncoach, Bewerbungstrainer',
                'billing_cycles' => [
                    [
                        'frequency' => [
                            'interval_unit' => 'MONTH',
                            'interval_count' => 1
                        ],
                        'tenure_type' => 'REGULAR',
                        'sequence' => 1,
                        'total_cycles' => 0,
                        'pricing_scheme' => [
                            'fixed_price' => [
                                'value' => '20.00',
                                'currency_code' => 'EUR'
                            ]
                        ]
                    ]
                ],
                'payment_preferences' => [
                    'auto_bill_outstanding' => true,
                    'setup_fee' => [
                        'value' => '0',
                        'currency_code' => 'EUR'
                    ],
                    'setup_fee_failure_action' => 'CONTINUE',
                    'payment_failure_threshold' => 3
                ]
            ]);

        $planDiamant = $responseDiamant->json();

        if (!isset($planDiamant['id'])) {
            Log::error('PayPal createPlan (Diamant) response error: ', $planDiamant);
            return response()->json(['error' => 'Failed to create Diamant plan'], 500);
        }

        $planDiamantId = $planDiamant['id'];
        Log::info('PayPal createPlan (Diamant) response: ', $planDiamant);

        // Gib die Plan-IDs zurück oder speichere sie in der Datenbank
        return response()->json([
            'product_id' => $productId,
            'plan_gold_id' => $planGoldId,
            'plan_diamant_id' => $planDiamantId
        ]);
    }

    public function createSubscription(Request $request)
    {
        $planId = $request->input('plan_id'); // Plan-ID aus der Anfrage
        $description = $planId === 'P-5XT70630D04889123M2LLU5A' ? 'Gold Abonnement: Textinspirationen, Textanalyse, Bewerbungsunterlagen' : 'Diamant Abonnement: Textinspirationen, Textanalyse, Bewerbungsunterlagen, Lerncoach, Bewerbungstrainer';

        $response = Http::withBasicAuth('Abj-J9HxV5L4s1izmSlNl27AJLM0z71Z0BzLAVV4n7ClCYaxlBWEGdvfSBnSvY7beu-AhQv0YdMLOzcc', 'EP3Uw3x4sZqIuOAEtSKeUW3rKzVKjm4myz5Wt5IVZDpHjBberd-9CKPC_1l9gsQh7Rsx4Zc8-d8dNSDJ')
            ->post('https://api-m.sandbox.paypal.com/v1/billing/subscriptions', [
                'plan_id' => $planId,
                'subscriber' => [
                    'name' => [
                        'given_name' => 'Max',
                        'surname' => 'Mustermann'
                    ],
                    'email_address' => 'customer@studygenie.de'
                ],
                'application_context' => [
                    'brand_name' => 'StudyGenie',
                    'locale' => 'de-DE',
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'SUBSCRIBE_NOW',
                    'payment_method' => [
                        'payer_selected' => 'PAYPAL',
                        'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED'
                    ],
                    'return_url' => route('paypal.updateSubscription', ['plan_id' => $planId]), // Setze die Rückkehr-URL auf die Profilseite
                    'cancel_url' => route('profile') // Setze die Abbruch-URL auf die Profilseite
                ],
                'description' => $description
            ]);

        Log::info('PayPal createSubscription response: ', $response->json());

        return $response->json();
    }

    public function updateSubscription(Request $request)
    {
        $planId = $request->input('plan_id');
        $user = Auth::user();
        $planName = '';

        if ($planId === 'P-5XT70630D04889123M2LLU5A') {
            $user->subscription_name = 'gold';
            $planName = 'Gold Abonnement';
        } elseif ($planId === 'P-73N16093HM5621830M2LLU5I') {
            $user->subscription_name = 'diamant';
            $planName = 'Diamant Abonnement';
        }

        $user->save();

        return redirect()->route('profile')->with('success', "Herzlichen Glückwunsch, {$user->name}! Du hast jetzt das {$planName}.");
    }

    /**
     * Method to init the paypal order
     *
     * @param Request $request
     * @param string $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request, $name): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        if ($name == 'silber') {
            $user->updateSubscriptionStatus($name, null);
            return redirect()->route('profile')->with('success', "Herzlichen Glückwunsch, {$user->name}! Du hast jetzt das Silber Abonnement.");
        }

        $price = config("services.paypal.prices.$name", 10); // Standardpreis ist 10
        Session::put('name', $name);
        $response = $this->createPayPalOrder($name, $price);

        return $this->handlePayPalResponse($response);
    }

    /**
     * Method to handle the success response from PayPal
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    private function createPayPalOrder($name, $price): array
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal.credentials'));

        return $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel')
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $price
                    ]
                ]
            ]
        ]);
    }

    /**
     * Method to handle the success response from PayPal
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function handlePayPalResponse($response): \Illuminate\Http\RedirectResponse
    {
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cancel.payment')->with('error', 'Etwas ist schief gelaufen');
        } else {
            return redirect()->route('create.payment')->with('error', $response['message'] ?? 'Etwas ist schief gelaufen');
        }
    }
}
