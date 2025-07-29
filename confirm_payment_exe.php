<?php
ob_start();
if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $secret_key = 'sk_test_5434f622e146765623c95db285f5899f21da5074'; // Replace with your actual secret key

    $url = "https://api.paystack.co/transaction/verify/" . $reference;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key",
        "Cache-Control: no-cache",
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {

        echo "cURL Error #:" . $err;
        header('Location: ' . 'confirm_payment.php?id=1&reference=' . $reference . '&status=fail');
    } else {
        $result = json_decode($response, true);
        if ($result['data']['status'] === 'success') {
            // echo "<h1>Hello</h1>";
            header('Location: ' . 'confirm_payment.php?id=2&reference=' . $reference . '&status=success');
        } elseif ($result['data']['status'] === 'failed') {
            header('Location: ' . 'confirm_payment.php?id=2&reference=' . $reference . '&status=fail');
        } else {
            header('Location: ' . 'confirm_payment.php?id=1&reference=' . $reference . '&status=fail');
        }
    }
}
