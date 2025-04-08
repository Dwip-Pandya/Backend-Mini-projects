<?php
session_start();
include 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['uid'])) {
    header("location:login.php");
    exit();
}

$userid = $_SESSION['uid'];

// Check if order_id is set in GET parameters
if (!isset($_GET['order_id'])) {
    header("location:my_orders.php"); // Redirect to orders page if no order ID provided
    exit();
}

$order_id = $_GET['order_id'];

// Verify that this order belongs to the logged-in user
$order_check_query = "SELECT * FROM tbl_orders WHERE order_id = ? AND user_id = ?";
$stmt = $connect->prepare($order_check_query);
$stmt->bind_param("ii", $order_id, $userid);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows == 0) {
    // Order doesn't exist or doesn't belong to this user
    header("location:my_orders.php");
    exit();
}

// Fetch order details
$order_details = $order_result->fetch_assoc();

// Fetch user details for shipping/billing information
$user_query = "SELECT * FROM tbl_user WHERE user_id = ?";
$stmt = $connect->prepare($user_query);
$stmt->bind_param("i", $userid);
$stmt->execute();
$user_result = $stmt->get_result();
$user_details = $user_result->fetch_assoc();

// Fetch order items with product details
$order_items_query = "
    SELECT oi.*, p.product_name, p.description, p.price, p.image1
    FROM tbl_order_items oi
    JOIN tbl_products p ON oi.product_id = p.product_id
    WHERE oi.order_id = ?
";
$stmt = $connect->prepare($order_items_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items_result = $stmt->get_result();

// Calculate subtotal
$subtotal = 0;
$order_items = [];
while ($item = $order_items_result->fetch_assoc()) {
    $item_total = $item['price'] * $item['quantity'];
    $subtotal += $item_total;
    $item['item_total'] = $item_total;
    $order_items[] = $item;
}

// Calculate other values
$shipping = 9.99;
$discount = 15.00; // You might want to fetch this from a discounts table
$tax_rate = 0.0725; // Example tax rate - you might want to adjust this or fetch from settings
$tax = $subtotal * $tax_rate;
$grand_total = $subtotal + $shipping - $discount + $tax;

// Determine order status and progress
$status = $order_details['order_status'];
$status_classes = [
    'Pending' => 'pending',
    'Processing' => 'processing',
    'Shipped' => 'shipped',
    'Out for Delivery' => 'out-for-delivery',
    'Delivered' => 'delivered',
    'Cancelled' => 'cancelled'
];

$status_class = $status_classes[$status] ?? 'pending';

// Calculate progress percentage based on status
$progress_percentages = [
    'Pending' => 0,
    'Processing' => 25,
    'Shipped' => 50,
    'Out for Delivery' => 75,
    'Delivered' => 100,
    'Cancelled' => 0
];

$progress_percentage = $progress_percentages[$status] ?? 0;

// Format order date
$order_date = date('F j, Y', strtotime($order_details['order_datetime'] ?? date('Y-m-d')));

// Generate order number (prefix + order ID)
$order_number = 'QK' . str_pad($order_id, 6, '0', STR_PAD_LEFT);

// Estimate delivery date (5-7 days from order date)
$delivery_date = date('F j, Y', strtotime($order_details['order_datetime'] . ' + 7 days'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order - QuickKart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/view_order.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container view-order-container">
        <!-- Page Header -->
        <div class="order-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Your Order Details</h1>
                    <p class="order-number">Order #<?php echo $order_number; ?> - Placed on <?php echo $order_date; ?></p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="status-badge <?php echo $status_class; ?>"><?php echo $status; ?></span>
                </div>
            </div>
        </div>

        <!-- Order Status Tracker -->
        <div class="order-status-tracker">
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_percentage; ?>%"
                        aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <ul class="progress-steps">
                    <li class="<?php echo ($status == 'Pending' || $progress_percentage >= 0) ? 'completed' : ''; ?>">
                        <div class="step-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="step-label">Ordered</div>
                    </li>
                    <li class="<?php echo ($status == 'Processing' || $progress_percentage >= 25) ? 'completed' : ''; ?>
                              <?php echo ($status == 'Processing') ? 'current' : ''; ?>">
                        <div class="step-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="step-label">Processing</div>
                    </li>
                    <li class="<?php echo ($status == 'Shipped' || $progress_percentage >= 50) ? 'completed' : ''; ?>
                              <?php echo ($status == 'Shipped') ? 'current' : ''; ?>">
                        <div class="step-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="step-label">Shipped</div>
                    </li>
                    <li class="<?php echo ($status == 'Out for Delivery' || $progress_percentage >= 75) ? 'completed' : ''; ?>
                              <?php echo ($status == 'Out for Delivery') ? 'current' : ''; ?>">
                        <div class="step-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="step-label">Out for Delivery</div>
                    </li>
                    <li class="<?php echo ($status == 'Delivered' || $progress_percentage >= 100) ? 'completed' : ''; ?>
                              <?php echo ($status == 'Delivered') ? 'current' : ''; ?>">
                        <div class="step-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="step-label">Delivered</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="order-content">
            <div class="row">
                <!-- Left Section - Order Items (70%) -->
                <div class="col-lg-8">
                    <div class="order-items">
                        <h2>Ordered Items</h2>

                        <?php foreach ($order_items as $item): ?>
                            <div class="product-card">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="product-image">
                                            <?php if (!empty($item['image1'])): ?>
                                                <img src="<?php echo htmlspecialchars($item['image1']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                                            <?php else: ?>
                                                <img src="/api/placeholder/100/100" alt="Product Image">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <h3><?php echo htmlspecialchars($item['product_name']); ?></h3>
                                            <p><?php echo htmlspecialchars($item['description'] ?? 'No description available'); ?></p>
                                            <div class="product-specs">
                                                <?php if (isset($item['color'])): ?>
                                                    <span>Color: <?php echo htmlspecialchars($item['color']); ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($item['model'])): ?>
                                                    <span>Model: <?php echo htmlspecialchars($item['model']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-pricing">
                                            <div class="price-item">
                                                <span class="label">Price:</span>
                                                <span class="value">₹<?php echo number_format($item['price'], 2); ?></span>
                                            </div>
                                            <div class="price-item">
                                                <span class="label">Quantity:</span>
                                                <span class="value"><?php echo $item['quantity']; ?></span>
                                            </div>
                                            <div class="price-item subtotal">
                                                <span class="label">Subtotal:</span>
                                                <span class="value">₹<?php echo number_format($item['item_total'], 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Action Buttons -->
                        <div class="order-actions">
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-file-download"></i> Download Invoice
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-truck"></i> Track Shipment
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-headset"></i> Contact Support
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Section - Order Summary (30%) -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h2>Order Summary</h2>

                        <!-- Shipping Address -->
                        <div class="summary-section">
                            <h3>Shipping Address</h3>
                            <div class="address-info">
                                <p class="name"><?php echo htmlspecialchars($user_details['name'] ?? 'Name not available'); ?></p>
                                <p><?php echo htmlspecialchars($order_details['shipping_address'] ?? 'Address not available'); ?></p>
                                <p><?php echo htmlspecialchars($order_details['city'] ?? ''); ?>,
                                    <?php echo htmlspecialchars($order_details['state'] ?? ''); ?>
                                    <?php echo htmlspecialchars($order_details['zip'] ?? ''); ?></p>
                                <p>India</p>
                                <p>Phone: <?php echo htmlspecialchars($user_details['phone'] ?? 'Phone not available'); ?></p>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="summary-section">
                            <h3>Billing Address</h3>
                            <div class="address-info">
                                <p class="name"><?php echo htmlspecialchars($user_details['name'] ?? 'Name not available'); ?></p>
                                <p><?php echo htmlspecialchars($order_details['shipping_address'] ?? 'Address not available'); ?></p>
                                <p><?php echo htmlspecialchars($order_details['city'] ?? ''); ?>,
                                    <?php echo htmlspecialchars($order_details['state'] ?? ''); ?>
                                    <?php echo htmlspecialchars($order_details['zip'] ?? ''); ?></p>
                                <p>India</p>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="summary-section">
                            <h3>Payment Method</h3>
                            <div class="payment-info">
                                <p>
                                    <?php
                                    $payment_method = $order_details['payment_method'] ?? 'Not specified';
                                    $payment_icon = 'fa-credit-card';

                                    // Set appropriate icon based on payment method
                                    if (stripos($payment_method, 'visa') !== false) {
                                        $payment_icon = 'fab fa-cc-visa';
                                    } elseif (stripos($payment_method, 'mastercard') !== false) {
                                        $payment_icon = 'fab fa-cc-mastercard';
                                    } elseif (stripos($payment_method, 'upi') !== false) {
                                        $payment_icon = 'fas fa-mobile-alt';
                                    } elseif (stripos($payment_method, 'cash') !== false) {
                                        $payment_icon = 'fas fa-money-bill-wave';
                                    }
                                    ?>
                                    <i class="<?php echo $payment_icon; ?>"></i> <?php echo htmlspecialchars($payment_method); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Delivery Details -->
                        <div class="summary-section">
                            <h3>Delivery Details</h3>
                            <div class="delivery-info">
                                <p>Expected Delivery Date: <strong><?php echo $delivery_date; ?></strong></p>
                                <p>Shipping Method: <strong>Standard Shipping</strong></p>
                                <?php if (isset($order_details['tracking_number']) && !empty($order_details['tracking_number'])): ?>
                                    <p>Tracking Number: <strong><?php echo htmlspecialchars($order_details['tracking_number']); ?></strong></p>
                                <?php else: ?>
                                    <p>Tracking Number: <strong><?php echo $order_number . 'US'; ?></strong></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="summary-section price-breakdown">
                            <h3>Price Breakdown</h3>
                            <div class="price-details">
                                <div class="price-item">
                                    <span class="label">Subtotal:</span>
                                    <span class="value">₹<?php echo number_format($subtotal, 2); ?></span>
                                </div>
                                <div class="price-item">
                                    <span class="label">Shipping:</span>
                                    <span class="value">₹<?php echo number_format($shipping, 2); ?></span>
                                </div>
                                <div class="price-item">
                                    <span class="label">Discount:</span>
                                    <span class="value">-₹<?php echo number_format($discount, 2); ?></span>
                                </div>
                                <div class="price-item">
                                    <span class="label">Tax:</span>
                                    <span class="value">₹<?php echo number_format($tax, 2); ?></span>
                                </div>
                                <div class="price-item total">
                                    <span class="label">Total:</span>
                                    <span class="value">₹<?php echo number_format($grand_total, 2); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>