<?php
session_start();
include 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['uid'])) {
    header("location:login.php");
    exit();
}

$userid = $_SESSION['uid'];

// Fetch user details
$user_query = "SELECT * FROM tbl_user WHERE user_id = ?";
$stmt = $connect->prepare($user_query);
$stmt->bind_param("i", $userid);
$stmt->execute();
$user_result = $stmt->get_result();
$user_details = $user_result->fetch_assoc();

// Fetch cart items with product details
$cart_query = "
    SELECT c.cart_id, c.product_id, c.quantity, p.product_name, p.price, p.image1 
    FROM tbl_cart c 
    JOIN tbl_products p ON c.product_id = p.product_id 
    WHERE c.user_id = ?
";
$stmt = $connect->prepare($cart_query);
$stmt->bind_param("i", $userid);
$stmt->execute();
$cart_result = $stmt->get_result();

// Calculate order summary
$subtotal = 0;
$shipping = 5.99;
$discount = 10.00;
$cart_items = [];

while ($cart_item = $cart_result->fetch_assoc()) {
    $item_total = $cart_item['price'] * $cart_item['quantity'];
    $subtotal += $item_total;
    $cart_item['item_total'] = $item_total;
    $cart_items[] = $cart_item;
}

$grand_total = $subtotal + $shipping - $discount;

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    // Validate form inputs
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];

    // Insert order details
    $order_query = "INSERT INTO tbl_orders (user_id, total_amount, shipping_address, city, state, zip, payment_method, order_status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
    $stmt = $connect->prepare($order_query);
    $stmt->bind_param("idsssss", $userid, $grand_total, $address, $city, $state, $zip, $payment_method);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $order_id = $connect->insert_id;

        // Insert order items
        $order_item_query = "INSERT INTO tbl_order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($order_item_query);
        foreach ($cart_items as $item) {
            $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Clear cart after order placement
        $clear_cart_query = "DELETE FROM tbl_cart WHERE user_id = ?";
        $stmt = $connect->prepare($clear_cart_query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();

        // Redirect to order confirmation
        if ($payment_method == "UPI") {
            // Redirect to UPI payment page
            header("Location: payment_page.php?order_id=".$order_id);
            exit();
        } else if ($payment_method == "Cash on Delivery") {
          // Redirect to thank you page for Cash on Delivery
          header("Location: thankyou.php?order_id=".$order_id);
          exit();
        } else {
        $error_message = "There was an error processing your order. Please try again.";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Online Shopping</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
    <!-- header section  -->
    <?php
    include 'theme-parts/header.php';
    ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 checkout-container">
                <h2 class="mb-4">Checkout</h2>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name"
                                value="<?php echo htmlspecialchars($user_details['name'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo htmlspecialchars($user_details['email'] ?? ''); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="<?php echo htmlspecialchars($user_details['phone'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="UPI">UPI</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" required>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header order-summary-details">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($cart_items as $cart_item): ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <?php echo htmlspecialchars($cart_item['product_name']); ?>
                                        <small class="text-muted">(x<?php echo $cart_item['quantity']; ?>)</small>
                                    </div>
                                    <div>₹ <?php echo number_format($cart_item['item_total'], 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Subtotal</strong>
                                <strong>₹ <?php echo number_format($subtotal, 2); ?></strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Shipping</span>
                                <span>₹ <?php echo number_format($shipping, 2); ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Discount</span>
                                <span>-₹ <?php echo number_format($discount, 2); ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5>Total</h5>
                                <h5>₹ <?php echo number_format($grand_total, 2); ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <!-- Changed from anchor tag to submit button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100" name="place_order">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 px-4">
                <div class="card" id="payment-methods-card">
                    <div class="card-header">
                        <h4>Payment Methods</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-credit-card me-2"></i>Credit/Debit Cards</li>
                            <li class="mb-2"><i class="bi bi-phone me-2"></i>UPI Payments</li>
                            <li><i class="bi bi-cash me-2"></i>Cash on Delivery</li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-3" id="shipping-info-card">
                    <div class="card-header">
                        <h4>Shipping Information</h4>
                    </div>
                    <div class="card-body">
                        <p>Standard Shipping: ₹5.99</p>
                        <p>Estimated Delivery: 5-7 Business Days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Section -->
    <?php
    include 'theme-parts/footer.php';
    ?>

    <!-- Bootstrap JS Bundle with Popper (for dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>