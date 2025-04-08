<?php
session_start();
include 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['uid'])) {
    header("location:login.php");
    exit();
}

$userid = $_SESSION['uid'];

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = max(1, intval($_POST['quantity'])); // Ensure quantity is at least 1

    $update_query = "UPDATE tbl_cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
    $stmt = $connect->prepare($update_query);
    $stmt->bind_param("iii", $new_quantity, $cart_id, $userid);
    $stmt->execute();
}

// Handle item removal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];

    $remove_query = "DELETE FROM tbl_cart WHERE cart_id = ? AND user_id = ?";
    $stmt = $connect->prepare($remove_query);
    $stmt->bind_param("ii", $cart_id, $userid);
    $stmt->execute();

    // Redirect to refresh the page
    header("Location: cart.php");
    exit();
}

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome for trash icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cart.css">
    <style>
        .remove-item-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 5px;
            transition: color 0.3s ease;
        }

        .remove-item-btn:hover {
            color: #a71d2a;
        }
    </style>
</head>

<body>
    <?php include 'theme-parts/header.php'; ?>

    <section id="custom-cart-section">
        <div id="cart-container">
            <div id="cart-row">
                <!-- Left Column - Cart Items -->
                <div id="cart-items-column">
                    <h2 id="cart-title">Your Cart</h2>

                    <div id="cart-table">
                        <?php if (!empty($cart_items)): ?>
                            <?php foreach ($cart_items as $cart_item): ?>
                                <div class="cart-item-row">
                                    <div class="item-image-container">
                                        <img src="<?php echo htmlspecialchars($cart_item['image1']); ?>"
                                            alt="<?php echo htmlspecialchars($cart_item['product_name']); ?>">
                                    </div>
                                    <div class="item-details-container">
                                        <h3 class="item-name-heading">
                                            <?php echo htmlspecialchars($cart_item['product_name']); ?>
                                        </h3>
                                        <p class="item-price-text">
                                            ₹ <?php echo number_format($cart_item['price'], 2); ?>
                                        </p>
                                    </div>
                                    <div class="item-quantity-container">
                                        <form method="POST" action="">
                                            <div class="quantity-selector-wrapper">
                                                <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                                <input type="hidden" name="update_qty" value="1">
                                                <button type="button" class="quantity-decrease-btn">-</button>
                                                <input type="number" name="quantity"
                                                    value="<?php echo $cart_item['quantity']; ?>"
                                                    min="1"
                                                    class="quantity-input-field">
                                                <button type="button" class="quantity-increase-btn">+</button>
                                                <button type="submit" class="btn view-details-btn" id="update-btn">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="item-total-container">
                                        ₹ <?php echo number_format($cart_item['item_total'], 2); ?>
                                    </div>
                                    <div class="item-remove-container">
                                        <form method="POST" action="" class="remove-item-form">
                                            <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                            <input type="hidden" name="remove_item" value="1">
                                            <button type="submit" class="remove-item-btn">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-cart">Your cart is empty</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Rest of the code remains the same -->
                <div id="order-summary-column">
                    <div id="summary-box">
                        <h2 id="summary-title">Order Summary</h2>

                        <div class="summary-row-item">
                            <span>Subtotal</span>
                            <span class="price-value">₹ <?php echo number_format($subtotal, 2); ?></span>
                        </div>

                        <div class="summary-row-item">
                            <span>Shipping Fee</span>
                            <span class="price-value">₹ <?php echo number_format($shipping, 2); ?></span>
                        </div>

                        <div class="summary-row-item" id="discount-row">
                            <span>Discount</span>
                            <span class="price-value">-₹ <?php echo number_format($discount, 2); ?></span>
                        </div>

                        <div class="summary-row-item" id="total-row">
                            <span>Grand Total</span>
                            <span class="price-value">₹ <?php echo number_format($grand_total, 2); ?></span>
                        </div>

                        <a href="checkout.php?" style="text-decoration: none;">
                            <button id="checkout-button">Proceed to Checkout</button>
                        </a>
                        <a href="products2.php?subcategoryid=1&categoryid=1" style="text-decoration: none;">
                            <button id="continue-shopping-button">Continue Shopping</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'theme-parts/footer.php'; ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Quantity adjustment functionality
        document.querySelectorAll('.cart-item-row').forEach(row => {
            const decreaseBtn = row.querySelector('.quantity-decrease-btn');
            const increaseBtn = row.querySelector('.quantity-increase-btn');
            const quantityInput = row.querySelector('.quantity-input-field');

            decreaseBtn.addEventListener('click', () => {
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });

            increaseBtn.addEventListener('click', () => {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });
        });
    </script>
</body>

</html>