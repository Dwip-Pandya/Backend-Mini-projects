<?php
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - ShopKart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'theme-part/header.php'; ?>

    <main>
        <div class="container">
            <div class="page-header">
                <h2>Our Products</h2>
                <p>Discover our collection of high-quality products</p>
            </div>

            <div class="shop-controls">
                <div class="search-box">
                    <input type="text" placeholder="Search products...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="filter-controls">
                    <select name="category">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                        <option value="home">Home & Kitchen</option>
                        <option value="beauty">Beauty & Personal Care</option>
                    </select>
                    <select name="sort">
                        <option value="popular">Sort by: Popularity</option>
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="rating">Customer Rating</option>
                    </select>
                </div>
            </div>

            <div class="category-pills">
                <a href="#" class="category-pill active">All</a>
                <a href="#" class="category-pill">Electronics</a>
                <a href="#" class="category-pill">Clothing</a>
                <a href="#" class="category-pill">Books</a>
                <a href="#" class="category-pill">Home & Kitchen</a>
                <a href="#" class="category-pill">Beauty</a>
            </div>

            <div class="shop-grid">
                <?php
                // This would 
                $products = mysqli_query($connection,'SELECT * FROM tbl_product');
                foreach ($products as $product) {
                    echo '<div class="shop-card">';
                    echo '<div class="product-image">';
                    echo '        <img src="uploads/' . $product['product_image'] . '" alt="' . $product['product_name'] . '">';
                    echo '<div class="product-badge">New</div>';
                    echo '</div>';
                    echo '<div class="product-details">';
                    echo '<h3><a href="product-detail.php?id=' . $product['product_id'] . '">' . $product['product_name'] . '</a></h3>';
                    echo '<p class="product-price">$' . number_format($product['product_price'], 2) . '</p>';
                    echo '</div>';
                    echo '<div class="product-actions">';
                    echo '<a href="cartprocess.php?id='. $product['product_id'].'"><button class="add-to-cart-btn">';
                    echo '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    echo '</button></a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'theme-part/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to cart functionality
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                
                // AJAX call to add product to cart
                // Replace with actual implementation
                console.log('Adding product ID ' + productId + ' to cart');
                
                // Visual feedback
                this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
                this.classList.add('added');
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    this.classList.remove('added');
                }, 2000);
            });
        });
        
        // Wishlist functionality
        const wishlistButtons = document.querySelectorAll('.wishlist-btn');
        
        wishlistButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.querySelector('i').classList.toggle('far');
                this.querySelector('i').classList.toggle('fas');
                this.classList.toggle('active');
            });
        });
    });
    </script>
</body>
</html>