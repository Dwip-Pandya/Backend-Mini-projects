<?php
require('vendor/autoload.php'); // ✅ Razorpay SDK

use Razorpay\Api\Api;

// ✅ Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // ✅ Ensure JSON response

// ✅ Razorpay API credentials (Use your actual secret key)
$keyId = "rzp_test_cF1Zbsgks1AQbM";
$keySecret = "69P7e7S4GZJeWKl8NDos3nxU";

// ✅ Get amount & order ID from frontend
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['amount'], $data['order_id'])) {
    echo json_encode(["error" => "Invalid request data"]);
    exit;
}

$amount = (int) $data['amount']; // Ensure it's an integer
$order_id = $data['order_id']; // Order reference from DB

// ✅ Convert amount to paise (Razorpay uses paise, so 100 INR = 10000 paise)
$amount_paise = $amount * 100;

try {
    $api = new Api($keyId, $keySecret);

    // ✅ Create Razorpay Order
    $order = $api->order->create([
        'receipt' => "order_" . $order_id, // Unique order reference
        'amount' => $amount_paise, // Amount in paise
        'currency' => 'INR',
        'payment_capture' => 1 // Auto-capture payment
    ]);

    // ✅ Send JSON response to frontend
    echo json_encode([
        'id' => $order['id'], // Razorpay Order ID
        'amount' => $order['amount'],
        'order_ref' => $order_id
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => "Failed to create order: " . $e->getMessage()]);
}
