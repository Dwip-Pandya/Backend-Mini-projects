<?php
include "connect.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - ShopKart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include "theme-part/header.php"; ?>
    <main>
        <div class="container">
            <div class="page-header">
                <h2>Your Shopping Cart</h2>
                <p>Review and manage your selected items</p>
            </div>

            <div class="cart-container">
                <?php
                // Fetch cart items
                $cart_query = mysqli_query($connection, "SELECT * FROM tbl_cart");

                // Calculate order summary
                $subtotal = 0;
                $shipping = 5.99;
                $discount = 10.00;
                ?>

                <div class="cart-items">
                    <div class="cart-header">
                        <div class="product-info-header">Product</div>
                        <div class="product-price-header">Price</div>
                        <div class="product-quantity-header">Quantity</div>
                        <div class="product-total-header">Total</div>
                        <div class="product-remove-header"></div>
                    </div>

                    <?php
                    // Display cart items
                    if (mysqli_num_rows($cart_query) > 0) {
                        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                            // Get product details separately
                            $product_id = $cart_item['product_id'];
                            $product_query = mysqli_query($connection, "SELECT * FROM tbl_product WHERE product_id = '$product_id'");
                            $product = mysqli_fetch_assoc($product_query);

                            // Add to subtotal
                            $subtotal += $product['product_price'];
                    ?>
                            <div class="cart-item">
                                <div class="product-info">
                                    <div class="product-image">
                                        <img src="uploads/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
                                    </div>
                                    <div class="product-details">
                                        <h3><a href="product-detail.php?id=<?php echo $product_id; ?>"><?php echo $product['product_name']; ?></a></h3>
                                    </div>
                                </div>
                                <div class="product-price">$<?php echo number_format($product['product_price'], 2); ?></div>
                                <div class="product-quantity">
                                    <div class="quantity-control">
                                        <input type="number" value="1" min="1" class="quantity-input" readonly>
                                    </div>
                                </div>
                                <div class="product-total">$<?php echo number_format($product['product_price'], 2); ?></div>
                                <div class="product-remove">
                                    <a href="cart-remove.php?id=<?php echo $cart_item['cart_id']; ?>">
                                        <button class="remove-btn"><i class="fas fa-trash-alt"></i></button>
                                    </a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="empty-cart">Your cart is empty</div>';
                    }
                    ?>
                </div>

                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Shipping</span>
                        <span>$<?php echo number_format($shipping, 2); ?></span>
                    </div>
                    <div class="summary-item discount">
                        <span>Discount</span>
                        <span>-$<?php echo number_format($discount, 2); ?></span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>$<?php echo number_format(($subtotal + $shipping - $discount), 2); ?></span>
                    </div>
                    <a href="checkout.php"><button class="checkout-btn">Proceed to Checkout</button></a>
                    <a href="shop.php" class="continue-shopping">Continue Shopping</a>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include 'theme-part/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>