<?php
// Start the session
session_start();

// Include database connection
include 'connect.php';

// Check if cart ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $cart_id = $_GET['id'];
    
    // Sanitize the input
    $cart_id = mysqli_real_escape_string($connection, $cart_id);
    
    // Delete the item from the cart using cart_id
    $delete_query = "DELETE FROM tbl_cart WHERE cart_id = '$cart_id'";
    
    if(mysqli_query($connection, $delete_query)) {
        $_SESSION['message'] = "Product removed from cart successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error removing product from cart. Please try again.";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Invalid request. No cart item specified.";
    $_SESSION['message_type'] = "error";
}

// Redirect back to cart page
header("Location: cart.php");
exit();
?>