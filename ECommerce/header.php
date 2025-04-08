<?php
// Database connection
include 'connection.php';

// Fetch total categories
$sql_categories = "SELECT COUNT(*) AS total_categories FROM tbl_category";
$result_categories = $connect->query($sql_categories);
$total_categories = ($result_categories->num_rows > 0) ? $result_categories->fetch_assoc()['total_categories'] : 0;

// Fetch total subcategories
$sql_subcategories = "SELECT COUNT(*) AS total_subcategories FROM tbl_subcategory";
$result_subcategories = $connect->query($sql_subcategories);
$total_subcategories = ($result_subcategories->num_rows > 0) ? $result_subcategories->fetch_assoc()['total_subcategories'] : 0;

// Fetch total products
$sql_products = "SELECT COUNT(*) AS total_products FROM tbl_products";
$result_products = $connect->query($sql_products);
$total_products = ($result_products->num_rows > 0) ? $result_products->fetch_assoc()['total_products'] : 0;

?>

<div class="row summary-cards mb-4">
    <div class="col-4">
        <div class="card card-categories">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-tags me-3"></i>
                <div>
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text"><?php echo $total_categories; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-subcategories">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-layer-group me-3"></i>
                <div>
                    <h5 class="card-title">Total Subcategories</h5>
                    <p class="card-text"><?php echo $total_subcategories; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-products">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-box-open me-3"></i>
                <div>
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?php echo $total_products; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Second Row - Quick Actions -->
<div class="row quick-actions mb-4">
    <div class="col-3">
        <a href="admin-panel-add-user.php" class="btn btn-primary w-100">
            <i class="fas fa-user-plus me-2"></i>Add User
        </a>
    </div>
    <div class="col-3">
        <a href="admin-panel-add-product.php" class="btn btn-warning w-100">
            <i class="fas fa-box-open me-2"></i>Add Product
        </a>
    </div>
    <div class="col-3">
        <a href="addproduct.php" class="btn btn-success w-100">
            <i class="fas fa-folder-plus me-2"></i>Add Category
        </a>
    </div>
    <div class="col-3">
        <a href="addsubcat.php" class="btn btn-danger w-100">
            <i class="fas fa-tags me-2"></i>Add Subcategory

        </a>
    </div>
</div>