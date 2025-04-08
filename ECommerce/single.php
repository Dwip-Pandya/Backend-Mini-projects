<?php
session_start();
include('connection.php');
$product_id = isset($_GET['productid']) ? intval($_GET['productid']) : 0;

$product_query = mysqli_query($connect, "SELECT * FROM tbl_products WHERE product_id = $product_id");
$product = mysqli_fetch_array($product_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Contact Us</title>
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
    <link rel="stylesheet" href="css/product.css">
</head>

<body>
    <?php
    include 'theme-parts/header.php';
    ?>


    <section class="product-section py-5">
        <div class="container">
            <div class="row">
                <!-- Product Image (Left Side) -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="product-image-card">
                        <div class="product-image-container">
                            <img id="mainImage" src="<?php echo $product['image1']; ?>"
                                class="main-image"
                                alt="<?php echo $product['product_name']; ?>"
                                style="height: 200px; object-fit: contain;">
                            <div class="image-zoom-lens"></div>
                        </div>

                        <!-- Thumbnail Images -->
                        <div class="thumbnail-container mt-4">
                            <div class="row g-2">
                                <div class="col-3">
                                    <div class="thumbnail active" onclick="changeImage(this, '<?php echo $product['image1']; ?>')">
                                        <img id="mainImage" src="<?php echo $product['image1']; ?>"
                                            class="main-image"
                                            alt="<?php echo $product['product_name']; ?>"
                                            style="height: 200px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="thumbnail active" onclick="changeImage(this, '<?php echo $product['image2']; ?>')">
                                        <img src="<?php echo $product['image2']; ?>"
                                            class="main-image"
                                            alt="<?php echo ($product['product_name']); ?>"
                                            style="height: 200px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="thumbnail active" onclick="changeImage(this, '<?php echo $product['image3']; ?>')">
                                        <img id="mainImage" src="<?php echo $product['image3']; ?>"
                                            class="main-image"
                                            alt="<?php echo ($product['product_name']); ?>"
                                            style="height: 200px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="thumbnail active" onclick="changeImage(this, '<?php echo $product['image4']; ?>')">
                                        <img id="mainImage" src="<?php echo $product['image4']; ?>"
                                            class="main-image"
                                            alt="<?php echo ($product['product_name']); ?>"
                                            style="height: 200px; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details (Right Side) -->
                <div class="col-lg-6">
                    <div class="product-details-card">
                        <!-- Product Name -->
                        <h1 class="product-title">
                            <?php echo ($product['product_name']); ?>
                        </h1>

                        <!-- Ratings & Reviews -->
                        <div class="ratings mb-3">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </span>
                            <span class="reviews-count">(128 Reviews)</span>
                        </div>

                        <!-- Price -->
                        <div class="price-container mb-4">
                            <span class="current-price">
                                <?php echo ($product['price']); ?>₹
                            </span>
                            <span class="discount-badge">28% OFF</span>
                        </div>

                        <!-- Product Description -->
                        <div class="product-description mb-4">
                            <h2 class="section-title">Description</h2>
                            <p>
                                <?php echo ($product['description']); ?>
                            </p>

                            <!-- Key Features -->
                            <div class="key-features mt-3">
                                <div class="feature-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>
                                        <?php echo ($product['porduct_point1']); ?>
                                    </span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>
                                        <?php echo ($product['porduct_point2']); ?>
                                    </span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>
                                        <?php echo ($product['porduct_point3']); ?>
                                    </span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>
                                        <?php echo ($product['porduct_point4']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Availability & Shipping -->
                        <div class="availability-shipping mb-4">
                            <div class="availability in-stock">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>In Stock</span>
                            </div>
                            <div class="shipping">
                                <i class="bi bi-truck"></i>
                                <span>Free shipping. <strong>Estimated delivery: 2-4 business days</strong></span>
                            </div>
                        </div>

                        <!-- Add to Cart Section -->
                        <form id="addToCartForm" method="post" action="cartprocess.php">
                            <div class="add-to-cart-section" id="stickyAddToCart">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-3">
                                        <div class="quantity-selector">
                                            <button type="button" class="qty-btn" id="decreaseBtn">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                                            <button type="button" class="qty-btn" id="increaseBtn">+</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <?php
                                    if (isset($_SESSION["uid"])) {
                                    ?>
                                        <div class="col-md-9">
                                            <div class="action-buttons">
                                                <button type="submit" class="btn add-to-cart-btn">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="login.php" class="action-buttons">Login is Required</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
    include 'theme-parts/footer.php';
    ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Quantity selector functionality
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const quantityInput = document.getElementById('quantity');

        decreaseBtn.addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        increaseBtn.addEventListener('click', () => {
            if (quantityInput.value < 10) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            }
        });
        // Image change functionality
        function changeImage(element, newSrc) {
            // Remove active class from all thumbnails
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });

            // Add active class to clicked thumbnail
            element.classList.add('active');

            // Update the main image
            document.getElementById('mainImage').src = newSrc;
        }


        // Sticky add to cart on mobile
        window.addEventListener('scroll', function() {
            const addToCartSection = document.getElementById('stickyAddToCart');
            if (window.innerWidth < 992) {
                if (window.scrollY > 300) {
                    addToCartSection.classList.add('sticky');
                } else {
                    addToCartSection.classList.remove('sticky');
                }
            }
        });

        // Simple hover zoom effect (basic implementation)
        const mainImage = document.getElementById('mainImage');
        const zoomLens = document.querySelector('.image-zoom-lens');

        mainImage.addEventListener('mousemove', function(e) {
            const boundingRect = this.getBoundingClientRect();

            // Calculate cursor position relative to the image
            const x = e.clientX - boundingRect.left;
            const y = e.clientY - boundingRect.top;

            // Calculate position in percentage
            const xPercent = (x / boundingRect.width) * 100;
            const yPercent = (y / boundingRect.height) * 100;

            // Move the background position of the zoom lens
            zoomLens.style.backgroundImage = `url(${this.src})`;
            zoomLens.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
            zoomLens.style.display = 'block';
        });

        mainImage.addEventListener('mouseleave', function() {
            zoomLens.style.display = 'none';
        });
    </script>
</body>

</html>