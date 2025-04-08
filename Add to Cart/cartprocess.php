<?php
include 'connect.php';
session_start();
// Add product to cart
$q = mysqli_query($connection, "INSERT INTO tbl_cart (product_id) VALUES ('$pid')");
if ($q) {
    $_SESSION['message'] = "Product added to cart successfully!";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Failed to add product to cart. Please try again.";
    $_SESSION['message_type'] = "error";
}
// Redirect back to cart page
header("Location: shop.php");
exit();
?>