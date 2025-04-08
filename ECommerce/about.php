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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/about.css">
</head>

<body>
    <!-- header section  -->
    <?php
    include 'theme-parts/header.php';
    ?>

    <!-- About Us Section -->
    <section class="about-us-section py-5">
        <!-- Section 1: Brand Introduction -->
        <div class="container mb-5">
            <div class="row align-items-center">
                <!-- Left Side - Text Content -->
                <div class="col-lg-6 mb-4 mb-lg-0 fade-in">
                    <div class="about-content">
                        <h2 class="section-heading mb-3">Who We Are</h2>
                        <h4 class="section-subheading mb-4">Delivering Quality, Convenience, and Trust.</h4>
                        <p class="about-text mb-4">
                            At QuickKart, we believe shopping should be easy, fast, and reliable. With a wide range of
                            products,
                            seamless navigation, and unbeatable deals, we ensure you get the best shopping experience at
                            your fingertips.
                        </p>
                        <a href="#" class="btn shop-now-btn">Learn More</a>
                    </div>
                </div>
                <!-- Right Side - Image -->
                <div class="col-lg-6 fade-in">
                    <div class="about-image-wrapper">
                        <img src="images/about-1.jpg" alt="Happy Customers Shopping"
                            class="img-fluid about-image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Why Choose Us? -->
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side - Feature Highlights -->
                <div class="col-lg-6 mb-4 mb-lg-0 fade-in">
                    <div class="features-content">
                        <h2 class="section-heading mb-4">Why Choose QuickKart?</h2>

                        <div class="feature-box mb-4">
                            <div class="feature-icon">
                                <i class="bi bi-rocket-takeoff"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Fast & Reliable Delivery</h5>
                                <p>We ensure quick and safe delivery to your doorstep.</p>
                            </div>
                        </div>

                        <div class="feature-box mb-4">
                            <div class="feature-icon">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Best Deals & Discounts</h5>
                                <p>Shop with confidence and enjoy unbeatable prices.</p>
                            </div>
                        </div>

                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h5>24/7 Customer Support</h5>
                                <p>We're here to help anytime, anywhere.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Video or Image -->
                <div class="col-lg-6 fade-in">
                    <div class="about-video-wrapper">
                        <video class="img-fluid about-video" poster="images/about.jpg" controls>
                            <source src="video/bg.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php
    include 'theme-parts/footer.php';
    ?>

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Bootstrap JS Bundle with Popper (for dropdowns) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>