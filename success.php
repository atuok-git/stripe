<?php
require './vendor/autoload.php';
require 'API_key.php';

$secret_key = getApiKey('stripe_secret_key');
$public_key = getApiKey('stripe_public_key');

$stripe = new \Stripe\StripeClient($secret_key);

$session = $stripe->checkout->sessions->retrieve($_GET['session_id'], []);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>完了ページ</title>
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<?php
if ($session->payment_status === 'paid') {
    echo '<p>支払いが完了しました</p>';
}
if ($session->payment_status === 'unpaid') {
    echo '<p>支払いが完了していません</p>';
}
echo '<p><a href="payment.php">戻る</a></p>';
?>
</body>
</html>
