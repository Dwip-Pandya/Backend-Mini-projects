<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopKart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include 'theme-part/header.php';
    ?>
    <main>
        <div class="container">
            <div class="welcome-section">
                <h2>Welcome to ShopKart</h2>
                <p>Your minimalist shopping experience</p>
            </div>

            <div class="cards-container">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3>Add Products</h3>
                    <p>Add new products to your inventory with detailed descriptions and pricing.</p>
                    <a href="add_product.php" class="card-button">Get Started</a>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <h3>View Products</h3>
                    <p>Browse, search, and manage your entire product catalog in one place.</p>
                    <a href="view_products.php" class="card-button">Explore</a>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <h3>Shop</h3>
                    <p>Start shopping with our user-friendly interface and secure checkout.</p>
                    <a href="shop.php" class="card-button">Shop Now</a>
                </div>
            </div>
        </div>
    </main>
    <?php
    include 'theme-part/footer.php';
    ?>
    <script src="js/script.js"></script>
</body>

</html>