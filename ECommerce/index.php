<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Online Shopping</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icon s -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css"> 
</head>

<body>
    <!-- header section  -->
    <?php
    include 'theme-parts/header.php';
    ?>

    <section class="hero-section position-relative overflow-hidden">
        <!-- Video Background -->
        <div class="video-container">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="video/background.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-overlay"></div>
        </div>

        <!-- Text & CTA Overlay -->
        <div class="container hero-content">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-8 col-md-10">
                    <div class="hero-text text-white fade-in">
                        <h1 class="display-3 fw-bold mb-3">Shop Smarter, Live Better!</h1>
                        <h4 class="fw-light mb-4">Explore the best deals on electronics, clothing, and more – all in one
                            place!</h4>
                        <div class="hero-buttons">
                            <a href="products.php" class="btn btn-primary btn-lg shop-now-btn me-3 mb-2 mb-md-0">Shop Now</a>
                            <a href="about.php" class="btn btn-outline-light btn-lg explore-btn">About US</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Controls -->
        <button class="video-control" aria-label="Play/Pause video">
            <i class="fas fa-pause" id="control-icon"></i>
        </button>
    </section>

    <!-- Footer Section -->
    <?php
    include 'theme-parts/footer.php';
    ?>

    <!-- Bootstrap JS Bundle with Popper (for dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>