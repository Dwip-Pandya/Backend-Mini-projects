<?php
require('vendor/autoload.php'); // Razorpay SDK

use Razorpay\Api\Api;

// ✅ Razorpay API Credentials
$keyId = "rzp_test_cF1Zbsgks1AQbM";
$keySecret = "69P7e7S4GZJeWKl8NDos3nxU"; // 🔹 Add your Test Secret Key

// ✅ Get JSON data from Razorpay response
$data = json_decode(file_get_contents("php://input"), true);

// ✅ Validate incoming data
if (!isset($data['payment_id'], $data['order_id'], $data['signature'], $data['order_ref'])) {
    echo json_encode(["success" => false, "message" => "Invalid request data"]);
    exit;
}

$payment_id = $data['payment_id'];
$order_id = $data['order_id']; // Razorpay Order ID
$signature = $data['signature'];
$order_ref = (int) $data['order_ref']; // Your Order ID from DB (Ensure it's an integer)

try {
    $api = new Api($keyId, $keySecret);

    // ✅ Verify the payment signature
    $attributes = [
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature
    ];

    $api->utility->verifyPaymentSignature($attributes);

    // ✅ Payment is successful → Update database
    $conn = new mysqli("localhost", "root", "", "your_database_name");

    if ($conn->connect_error) {
        die(json_encode(["success" => false, "message" => "Database connection failed"]));
    }

    // ✅ Secure Query to prevent SQL Injection
    $stmt = $conn->prepare("UPDATE tbl_orders SET payment_status = 'Paid' WHERE order_id = ?");
    $stmt->bind_param("i", $order_ref);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Payment Verified!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database update failed."]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Payment verification failed: " . $e->getMessage()]);
}
