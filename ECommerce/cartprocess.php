<?php
session_start();
include 'connection.php';
// Ensure user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$user_id = $_SESSION['uid'];  // Get user ID from session

// Validate inputs
if ($product_id <= 0 || $quantity <= 0) {
    echo "Invalid product or quantity";
    exit();
}

// Check if the product exists
$product_check_query = "SELECT * FROM tbl_products WHERE product_id = ?";
$stmt = $connect->prepare($product_check_query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();

if ($product_result->num_rows == 0) {
    echo "Product not found";
    exit();
}

// Check if the product is already in the cart for this user
$check_query = "SELECT * FROM tbl_cart WHERE product_id = ? AND user_id = ?";
$stmt = $connect->prepare($check_query);
$stmt->bind_param("ii", $product_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If product exists, update quantity
    $update_query = "UPDATE tbl_cart SET quantity = quantity + ? WHERE product_id = ? AND user_id = ?";
    $stmt = $connect->prepare($update_query);
    $stmt->bind_param("iii", $quantity, $product_id, $user_id);
    $stmt->execute();
} else {
    // Insert new product into cart
    $insert_query = "INSERT INTO tbl_cart (product_id, quantity, user_id) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($insert_query);
    $stmt->bind_param("iii", $product_id, $quantity, $user_id);
    $stmt->execute();
}

// Redirect to cart page
header("Location: cart.php");
exit();
