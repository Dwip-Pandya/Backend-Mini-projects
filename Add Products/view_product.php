<?php
$connection = mysqli_connect('localhost', 'root', '', 'db_project3');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Initialize search variable
$search = "";
$where_clause = "";

// Handle search functionality
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $where_clause = "WHERE product_name LIKE '%{$search}%' OR product_details LIKE '%{$search}%'";
}

// Fetch products based on search criteria
$query = mysqli_query($connection, "SELECT * FROM tbl_product {$where_clause} ORDER BY product_id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="resource/view_style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Our Products</h1>
            <p>Browse through our collection of quality products</p>
        </div>

        <div class="actions">
            <form class="search-form" method="GET" action="">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fas fa-arrow-right"></i></button>
            </form>
            <a href="add_product.php" class="add-btn">
                <i class="fas fa-plus"></i>
                <span>Add New Product</span>
            </a>
        </div>

        <?php if (!empty($search)) { ?>
            <div class="search-results">
                Showing results for "<?php echo htmlspecialchars($search); ?>"
                <a href="view_product.php" class="search-reset">Clear search</a>
            </div>
        <?php } ?>

        <div class="products-grid">
            <?php
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $thumb1 = !empty($row['product_thumb1']) ? "uploads/" . $row['product_thumb1'] : "https://via.placeholder.com/300x200";
                    $thumb2 = !empty($row['product_thumb2']) ? "uploads/" . $row['product_thumb2'] : "";
                    $thumb3 = !empty($row['product_thumb3']) ? "uploads/" . $row['product_thumb3'] : "";
                    $thumb4 = !empty($row['product_thumb4']) ? "uploads/" . $row['product_thumb4'] : "";

                    $shortDetails = substr($row['product_details'], 0, 120) . (strlen($row['product_details']) > 120 ? '...' : '');
            ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img id="main-image-<?php echo $row['product_id']; ?>" src="<?php echo $thumb1; ?>" alt="<?php echo $row['product_name']; ?>">
                            <div class="product-thumbnails">
                                <?php if (!empty($thumb1)) { ?>
                                    <img src="<?php echo $thumb1; ?>" alt="Thumbnail 1" onclick="changeMainImage(this, <?php echo $row['product_id']; ?>)">
                                <?php } ?>
                                <?php if (!empty($thumb2)) { ?>
                                    <img src="<?php echo $thumb2; ?>" alt="Thumbnail 2" onclick="changeMainImage(this, <?php echo $row['product_id']; ?>)">
                                <?php } ?>
                                <?php if (!empty($thumb3)) { ?>
                                    <img src="<?php echo $thumb3; ?>" alt="Thumbnail 3" onclick="changeMainImage(this, <?php echo $row['product_id']; ?>)">
                                <?php } ?>
                                <?php if (!empty($thumb4)) { ?>
                                    <img src="<?php echo $thumb4; ?>" alt="Thumbnail 4" onclick="changeMainImage(this, <?php echo $row['product_id']; ?>)">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?php echo $row['product_name']; ?></h3>
                            <div class="product-price">$<?php echo number_format($row['product_price'], 2); ?></div>
                            <p class="product-description"><?php echo $shortDetails; ?></p>
                            <div class="product-actions">
                                <a href="view_product_details.php?id=<?php echo $row['product_id']; ?>" class="action-btn view-btn">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
            ?>
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>No Products Found</h3>
                    <?php if (!empty($search)) { ?>
                        <p>We couldn't find any products matching your search "<?php echo htmlspecialchars($search); ?>". Please try a different search term.</p>
                    <?php } else { ?>
                        <p>You haven't added any products yet. Add your first product to get started.</p>
                    <?php } ?>
                    <a href="add_product.php" class="add-btn">
                        <i class="fas fa-plus"></i>
                        <span>Add New Product</span>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>