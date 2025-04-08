<?php
include 'connection.php';
?>
<header class="sticky-top">
    <!-- First Row - Info & Branding Section -->
    <div class="container-fluid top-bar">
        <div class="row py-2 align-items-center">
            <!-- Left Section: Contact Information -->
            <div class="col-md-4 contact-info">
                <i class="bi bi-telephone-fill"></i>
                <span>Call Us: +123 456 7890</span>
            </div>

            <!-- Center Section: Brand Name -->
            <div class="col-md-4 text-center brand-name">
                <h1>QuickKart</h1>
            </div>

            <!-- Right Section: Search Bar -->
            <div class="col-md-4">
                <form class="d-flex search-form" action="search.php" method="GET">
                    <input class="form-control search-input" type="search" name="query" placeholder="Search for products..." required>
                    <button class="btn search-btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Second Row - Navigation Menu with Three Sections -->
    <nav class="navbar navbar-expand-lg main-menu">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- Left Section: Home -->
                <ul class="navbar-nav left-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                </ul>

                <!-- Center Section: Category Menus -->
                <ul class="navbar-nav center-menu">
                    <?php

                    // Fetch the category name
                    $category_id = isset($_GET['categoryid']) ? intval($_GET['categoryid']) : 1;

                    $categoryq = mysqli_query($connect, "SELECT * FROM tbl_category");

                    while ($cdata = mysqli_fetch_array($categoryq)) {
                        echo "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='products.php?categoryid={$cdata['category_id']}' role='button' aria-expanded='false'>
                     {$cdata['category_name']}
                </a>";

                        // Fetch subcategories for the current category
                        $subcateq = mysqli_query($connect, "SELECT * FROM tbl_subcategory WHERE category_id = {$cdata['category_id']}");

                        if (mysqli_num_rows($subcateq) > 0) {
                            echo "<ul class='dropdown-menu'>";
                            while ($subdata = mysqli_fetch_array($subcateq)) {
                                echo "<li>

                                <a class='dropdown-item' href='products2.php?subcategoryid={$subdata['subcat_id']}&categoryid={$cdata['category_id']}'>

                        {$subdata['subcat_name']}
                      </a></li>";
                            }
                            echo "</ul>";
                        }

                        echo "</li>";
                    }
                    ?>
                </ul>


                <!-- Right Section: Account, Cart, Contact -->
                <ul class="navbar-nav right-menu">
                    <?php

                    if (isset($_SESSION['uid'])) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="login.php"> &nbsp;&nbsp;&nbsp;
                                <i class="bi bi-person-circle"></i> Hi,
                                <?php echo $_SESSION['uname'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                <li><a class="dropdown-item" href="my_orders.php">Your orders</a></li>
                            </ul>
                          
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="bi bi-cart-fill"></i> Your Cart
                            </a>
                        </li>
                    <?php
                    } else {
                        echo '<a class="nav-link" href="login.php"> &nbsp;&nbsp;&nbsp;
                            <i class="bi bi-person-circle"></i> Login
                        </a>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="bi bi-chat-dots-fill"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>