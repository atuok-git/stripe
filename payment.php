<?php
require 'API_key.php';

$secret_key = getApiKey('stripe_secret_key');
$public_key = getApiKey('stripe_public_key');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>支払いページ</title>
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<button id="checkout-button">支払う</button>
<script type="text/javascript">
var stripe = Stripe('<?php echo $public_key;?>');

var checkoutButton = document.getElementById('checkout-button');
checkoutButton.addEventListener('click', function() {
    fetch("https://tukune.tk/stripe/charge.php", {
        method: "POST",
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (session) {
        return stripe.redirectToCheckout({sessionId: session.id });
    })
    .then(function (result) {
        if (result.error) {
            var displayError = document.getElementById('error-message');
            displayError.textContent = result.error.message;
        }
    });
});
/*
checkoutButton.addEventListener('click', function() {
    console.log('aaa');
});
 */

</script>
</body>
</html>
