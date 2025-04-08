<?php
include 'connect.php';

// Fetch products from database
$sql = "SELECT * FROM tbl_product";
$result = $connection->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - ShopKart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/view_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'theme-part/header.php'; ?>

    <main>
        <div class="container">
            <div class="page-header">
                <h2>Product Inventory</h2>
                <p>Manage and view all your available products</p>
            </div>

            <div class="product-controls">
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
                </div>
                <a href="add_product.php" class="add-product-btn">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>

            <div class="products-grid">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        echo '<div class="product-card">';
                        echo '   <div class="product-image">';
                        echo '        <img src="uploads/' . $row['product_image'] . '" alt="' . $row['product_name'] . '">';
                        echo '    </div>';
                        echo '    <div class="product-details">';
                        echo '        <h3>' . $row['product_name'] . '</h3>';
                        echo '        <p class="product-price">$' . number_format($row['product_price'], 2) . '</p>';
                        echo '    </div>';
                        echo '    <div class="product-actions">';
                        echo '        <a href="edit_product.php?id=' . $row['product_id'] . '" class="action-btn edit-btn">';
                        echo '            <i class="fas fa-edit"></i>';
                        echo '        </a>';
                        echo '        <a href="delete_product.php?did='. $row['product_id'].'" class="action-btn delete-btn" onclick="return confirm(\'Are you sure?\')">';
                        echo '            <i class="fas fa-trash-alt"></i>';
                        echo '        </a>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No products found.</p>';
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'theme-part/footer.php'; ?>
</body>

</html>