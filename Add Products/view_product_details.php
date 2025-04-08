<?php
$connection = mysqli_connect('localhost', 'root', '', 'db_project3');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_product.php");
    exit();
}

// Get product ID and sanitize it
$product_id = mysqli_real_escape_string($connection, $_GET['id']);

// Fetch product details
$query = mysqli_query($connection, "SELECT * FROM tbl_product WHERE product_id = '$product_id'");

// Check if product exists
if (mysqli_num_rows($query) == 0) {
    header("Location: view_product.php");
    exit();
}

// Get product data
$product = mysqli_fetch_assoc($query);

// Fetch related products (same category or similar price range)
$related_query = mysqli_query($connection, "SELECT * FROM tbl_product WHERE product_id != '$product_id' ORDER BY RAND() LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']; ?> - Product Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resource/details_style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Product Details</h1>
            <div class="navigation">
                <a href="view_product.php" class="nav-btn back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Products</span>
                </a>
            </div>
        </div>

        <div class="product-container">
            <div class="product-gallery">
                <div class="main-image">
                    <?php
                    $main_image = !empty($product['product_thumb1']) ? "uploads/" . $product['product_thumb1'] : "https://via.placeholder.com/400x400";
                    ?>
                    <img id="main-product-image" src="<?php echo $main_image; ?>" alt="<?php echo $product['product_name']; ?>">
                </div>
                <div class="thumbnails">
                    <?php
                    $thumbs = [
                        !empty($product['product_thumb1']) ? "uploads/" . $product['product_thumb1'] : null,
                        !empty($product['product_thumb2']) ? "uploads/" . $product['product_thumb2'] : null,
                        !empty($product['product_thumb3']) ? "uploads/" . $product['product_thumb3'] : null,
                        !empty($product['product_thumb4']) ? "uploads/" . $product['product_thumb4'] : null
                    ];

                    foreach ($thumbs as $index => $thumb) {
                        if (!empty($thumb)) {
                            $active_class = $index === 0 ? 'active' : '';
                            echo "<div class='thumbnail $active_class' onclick='changeImage(\"$thumb\")'>";
                            echo "<img src='$thumb' alt='Thumbnail " . ($index + 1) . "'>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="product-info">
                <h1 class="product-name"><?php echo $product['product_name']; ?></h1>
                <div class="product-price">
                    $<?php echo number_format($product['product_price'], 2); ?>
                    <?php if (!empty($product['original_price']) && $product['original_price'] > $product['product_price']) { ?>
                        <span class="original-price">$<?php echo number_format($product['original_price'], 2); ?></span>
                        <?php
                        $discount = round((($product['original_price'] - $product['product_price']) / $product['original_price']) * 100);
                        ?>
                        <span class="discount-badge"><?php echo $discount; ?>% OFF</span>
                    <?php } ?>
                </div>
                <div class="product-details">
                    <?php echo nl2br($product['product_details']); ?>
                </div>
                <div class="product-meta">
                    <?php if (!empty($product['product_sku'])) { ?>
                        <div class="meta-item">
                            <i class="fas fa-barcode"></i>
                            <span>SKU: <?php echo $product['product_sku']; ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($product['product_category'])) { ?>
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span>Category: <?php echo $product['product_category']; ?></span>
                        </div>
                    <?php } ?>
                    <div class="meta-item">
                        <i class="fas fa-box"></i>
                        <span>Stock: <?php echo !empty($product['product_stock']) ? $product['product_stock'] : 'Available'; ?></span>
                    </div>
                </div>
                <div class="product-actions">
                    <div class="quantity-control">
                        <span class="quantity-label">Quantity:</span>
                        <div class="quantity-input">
                            <button class="quantity-btn" onclick="decrementQuantity()">-</button>
                            <span class="quantity-value" id="quantity">1</span>
                            <button class="quantity-btn" onclick="incrementQuantity()">+</button>
                        </div>
                    </div>
                    <button class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                    <button class="wishlist-btn">
                        <i class="fas fa-heart"></i>
                        <span>Add to Wishlist</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to change main product image
        function changeImage(src) {
            document.getElementById('main-product-image').src = src;

            // Update active thumbnail
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.classList.remove('active');
                if (thumb.querySelector('img').src === src) {
                    thumb.classList.add('active');
                }
            });
        }

        // Functions to handle quantity
        function incrementQuantity() {
            const quantityElement = document.getElementById('quantity');
            let quantity = parseInt(quantityElement.innerText);
            quantityElement.innerText = quantity + 1;
        }

        function decrementQuantity() {
            const quantityElement = document.getElementById('quantity');
            let quantity = parseInt(quantityElement.innerText);
            if (quantity > 1) {
                quantityElement.innerText = quantity - 1;
            }
        }
    </script>
</body>

</html>