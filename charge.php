<?php
require './vendor/autoload.php';
require 'API_key.php';

$secret_key = getApiKey('stripe_secret_key');
$public_key = getApiKey('stripe_public_key');

$stripe = new \Stripe\StripeClient($secret_key);
                                           
$session = $stripe->checkout->sessions->create([
    'payment_method_types' => ['card'],
    'line_items' => [[                    
        'price_data' => [               
            'currency' => 'JPY',        
            'product_data' => [          
                'name' => '商品名',
                'images' => ["https://i.imgur.com/EHyR2nP.png"],
            ],
        'unit_amount' => 55,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    // ご自身のサイトURLを入力
    'success_url' => 'https://tukune.tk/stripe/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'https://tukune.tk/stripe/success.php?session_id={CHECKOUT_SESSION_ID}',
]);
echo json_encode(['id' => $session->id]);
/*
echo "<pre>";
print_r($stripe);
echo "<br>";
print_r($session);
 */
?>

