<?php
// PaymentsOS Credentials
$app_id = 'your_app_id';
$private_key = 'your_private_key';
$api_version = '1.3.0';
$env = 'test'; // Change to 'live' for production
$api_url = 'https://api.paymentsos.com/payments';

// Retrieve form data
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$email = $_POST['email'];
$name = $_POST['name'];
$card_number = $_POST['card_number'];
$expiry_month = $_POST['expiry_month'];
$expiry_year = $_POST['expiry_year'];
$cvv = $_POST['cvv'];

// Generate a unique transaction ID
$txnid = uniqid('txn_', true);

// Prepare payment data
$data = [
    'amount' => (int)$amount,
    'currency' => $currency,
    'payment_method' => [
        'type' => 'tokenized',
        'token' => [
            'number' => $card_number,
            'expiration_month' => $expiry_month,
            'expiration_year' => $expiry_year,
            'cvv' => $cvv
        ]
    ],
    'customer' => [
        'email' => $email,
        'name' => $name
    ],
    'reference' => $txnid
];

// Initialize cURL
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'api-version: ' . $api_version,
    'x-payments-os-env: ' . $env,
    'app-id: ' . $app_id,
    'private-key: ' . $private_key,
    'idempotency-key: ' . $txnid
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
if ($http_code == 201) {
    $response_data = json_decode($response, true);
    echo "Payment initiated successfully. Payment ID: " . $response_data['id'];
} else {
    echo "Error initiating payment. HTTP Status Code: " . $http_code;
    echo "<br>Response: " . $response;
}
?>
