<?php
include 'connection.php'; // Database connection

// Fetch categories
$categoryQuery = "SELECT * FROM tbl_category";
$categoriesResult = mysqli_query($connect, $categoryQuery);
$categories = [];
while ($row = mysqli_fetch_assoc($categoriesResult)) {
    $categories[] = $row;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = mysqli_real_escape_string($connect, $_POST['productName']);
    $productDescription = mysqli_real_escape_string($connect, $_POST['productDescription']);
    $price = (float) $_POST['price'];
    $stockQuantity = (int) $_POST['stockQuantity'];
    $category = (int) $_POST['category'];
    $subcategory = (int) $_POST['subcategory'];
    $feature1 = mysqli_real_escape_string($connect, $_POST['feature1']);
    $feature2 = mysqli_real_escape_string($connect, $_POST['feature2']);
    $feature3 = mysqli_real_escape_string($connect, $_POST['feature3']);
    $feature4 = mysqli_real_escape_string($connect, $_POST['feature4']);

    // Image Upload Handling
    $targetDir = "uploads/products/";
    $images = [];
    for ($i = 1; $i <= 4; $i++) {
        $imageField = "image$i";
        if (!empty($_FILES[$imageField]['name'])) {
            $imageName = time() . "_" . basename($_FILES[$imageField]['name']);
            $targetFilePath = $targetDir . $imageName;
            if (move_uploaded_file($_FILES[$imageField]['tmp_name'], $targetFilePath)) {
                $images[] = $imageName;
            } else {
                $images[] = null;
            }
        } else {
            $images[] = null;
        }
    }

    // Insert product into database
    $query = "INSERT INTO tbl_products (product_name, description, price, stock_quantity, category_id, subcat_id, image1, image2, image3, image4, porduct_point1, porduct_point2, porduct_point3, porduct_point4) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "ssdiiissssssss", $productName, $productDescription, $price, $stockQuantity, $category, $subcategory, $images[0], $images[1], $images[2], $images[3], $feature1, $feature2, $feature3, $feature4);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Product added successfully!'); window.location.href='product-list.php';</script>";
    } else {
        echo "<script>alert('Error adding product!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/admin-styles.css" rel="stylesheet">
    <link href="css/product-admin.css" rel="stylesheet">


    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar (20%) -->
            <?php
            include 'sidebar.php';
            ?>

            <!-- Right Content Area (80%) -->
            <div class="col-10 main-content">
                <?php
                include 'header.php'
                ?>

                <div class="form">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="mb-1"><i class="fas fa-box-open me-2"></i>Add a New Product</h3>
                            <p class="text-muted mb-0">Fill out the details below to add a new product to QuickKart.</p>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" id="addProductForm">
                                <div class="row">
                                    <!-- Left Column (70%) - Product Details -->
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="productName" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productDescription" class="form-label">Description</label>
                                                    <textarea class="form-control" id="productDescription" name="productDescription" rows="4" placeholder="Describe the product in detail..." required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>Key Features</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="feature1" class="form-label">Feature 1</label>
                                                        <input type="text" class="form-control" id="feature1" name="feature1" placeholder="Enter feature">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="feature2" class="form-label">Feature 2</label>
                                                        <input type="text" class="form-control" id="feature2" name="feature2" placeholder="Enter feature">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="feature3" class="form-label">Feature 3</label>
                                                        <input type="text" class="form-control" id="feature3" name="feature3" placeholder="Enter feature">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="feature4" class="form-label">Feature 4</label>
                                                        <input type="text" class="form-control" id="feature4" name="feature4" placeholder="Enter feature">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Pricing & Stock</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="price" class="form-label">Price ($)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" placeholder="0.00" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="stockQuantity" class="form-label">Stock Quantity</label>
                                                        <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" min="0" placeholder="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Categorization</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="category" class="form-label">Category</label>
                                                        <select name="category" id="category" onchange="fetchSubcategories(this.value)" required>
                                                            <option value="">Select a category</option>
                                                            <?php foreach ($categories as $cat) { ?>
                                                                <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Subcategory:</label>
                                                        <select name="subcategory" id="subcategory" required>
                                                            <option value="">Select a subcategory</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column (30%) - Image Upload -->
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-images me-2"></i>Product Images</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="image1" class="form-label">Main Image</label>
                                                    <div class="image-upload-container" id="image1Container">
                                                        <div class="image-preview" id="image1Preview">
                                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                            <p>Drag & drop or click to upload</p>
                                                        </div>
                                                        <input type="file" class="form-control visually-hidden" id="image1" name="image1" accept="image/*" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image2" class="form-label">Image 2</label>
                                                    <div class="image-upload-container" id="image2Container">
                                                        <div class="image-preview" id="image2Preview">
                                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                            <p>Drag & drop or click to upload</p>
                                                        </div>
                                                        <input type="file" class="form-control visually-hidden" id="image2" name="image2" accept="image/*">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image3" class="form-label">Image 3</label>
                                                    <div class="image-upload-container" id="image3Container">
                                                        <div class="image-preview" id="image3Preview">
                                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                            <p>Drag & drop or click to upload</p>
                                                        </div>
                                                        <input type="file" class="form-control visually-hidden" id="image3" name="image3" accept="image/*">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image4" class="form-label">Image 4</label>
                                                    <div class="image-upload-container" id="image4Container">
                                                        <div class="image-preview" id="image4Preview">
                                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                            <p>Drag & drop or click to upload</p>
                                                        </div>
                                                        <input type="file" class="form-control visually-hidden" id="image4" name="image4" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4 action-buttons">
                                    <button type="reset" class="btn btn-light me-2">
                                        <i class="fas fa-undo me-1"></i> Reset Form
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle me-1"></i> Add Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.mobile-sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>

</html>