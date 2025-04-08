<?php
session_start();
include('connection.php');

$category_id = isset($_GET['categoryid']) ? intval($_GET['categoryid']) : 0;
$subcategory_id = isset($_GET['subcategoryid']) ? intval($_GET['subcategoryid']) : 0;

// Fetch the subcategory name
$subcateq = mysqli_query($connect, "SELECT * FROM tbl_subcategory WHERE subcat_id = $subcategory_id");
$subcategory = mysqli_fetch_assoc($subcateq);
$subcategory_name = $subcategory['subcat_name'] ?? 'Unknown Subcategory';

// Fetch the category name
$categoryq = mysqli_query($connect, "SELECT * FROM tbl_category WHERE category_id = $category_id");
$category = mysqli_fetch_assoc($categoryq);
$category_name = $category['category_name'] ?? 'Unknown Category';

// Fetch products based on category and subcategory
$productQuery = "SELECT product_id, product_name, description, price, image1 FROM tbl_products WHERE category_id = $category_id";

if ($subcategory_id > 0) {
    $productQuery .= " AND subcat_id = $subcategory_id";
}
$productq = mysqli_query($connect, $productQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include('theme-parts/header.php');
    ?>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Left Side - Category Box (30%) -->
            <div class="col-md-4 col-lg-3 categories-sidebar">
                <div class="category-box">
                    <div class="category-header">
                        <?php
                        // Fetch the selected category ID from the URL
                        $category_id = isset($_GET['categoryid']) ? intval($_GET['categoryid']) : 0;

                        // Fetch the main category name
                        $category_query = mysqli_query($connect, "SELECT category_name FROM tbl_category WHERE category_id = $category_id");
                        $category_data = mysqli_fetch_assoc($category_query);

                        if ($category_data) {
                            echo "<h2><i class='fas fa-list-ul'></i> " . $category_data['category_name'] . "</h2>";
                        } else {
                            echo "<h2><i class='fas fa-list-ul'></i> Browse Categories</h2>";
                        }
                        ?>
                    </div>
                    <div class="category-content">
                        <ul class="category-list">
                            <?php
                            // Fetch all subcategories related to the selected category
                            $subcate_query = mysqli_query($connect, "SELECT * FROM tbl_subcategory WHERE category_id = $category_id");

                            if (mysqli_num_rows($subcate_query) > 0) {
                                while ($subdata = mysqli_fetch_assoc($subcate_query)) {
                                    echo "<li class='category-item'>
                                <a href='products2.php?subcategoryid={$subdata['subcat_id']}&categoryid={$category_id}'>
                                    <i class='fas fa-chevron-right'></i> {$subdata['subcat_name']}
                                </a>
                              </li>";
                                }
                            } else {
                                echo "<li class='category-item'><a href='#'>No Subcategories Found</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Right Side - Product Listing (70%) -->
            <div class="col-md-8 col-lg-9 product-listing">
                <div class="product-header">
                    <h1 id="category-title"><?php echo $subcategory_name; ?></h1>
                    <p class="category-description">Browse our latest <?php echo $subcategory_name; ?> products under <?php echo $category_name; ?></p>
                </div>

                <div class="row product-grid">
                    <?php
                    if (mysqli_num_rows($productq) > 0) {
                        while ($product = mysqli_fetch_assoc($productq)) {
                    ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card product-card">
                                    <img src="<?php echo $product['image1']; ?>"
                                        class="card-img-top"
                                        alt="<?php echo ($product['product_name']); ?>"
                                        style="height: 200px; object-fit: contain;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                        <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                                        <a href="single.php?productid=<?php echo $product['product_id']; ?>" class="btn btn-primary view-details-btn">
                                            View Details <i class="fas fa-arrow-right"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>No products found in this category.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('theme-parts/footer.php');
    ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>