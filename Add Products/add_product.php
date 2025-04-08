<?php
$connection = mysqli_connect('localhost', 'root', '', 'db_project3');

// Check if the form is submitted
if (isset($_POST['btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $thumb1 = mysqli_real_escape_string($connection, $_FILES['thumbnail1']['name']);
    $thumb2 = mysqli_real_escape_string($connection, $_FILES['thumbnail2']['name']);
    $thumb3 = mysqli_real_escape_string($connection, $_FILES['thumbnail3']['name']);
    $thumb4 = mysqli_real_escape_string($connection, $_FILES['thumbnail4']['name']);
    $product_details = mysqli_real_escape_string($connection, $_POST['details']);

    $target_dir = "uploads/";
    $upload1 = move_uploaded_file($_FILES['thumbnail1']['tmp_name'], $target_dir . basename($thumb1));
    $upload2 = move_uploaded_file($_FILES['thumbnail2']['tmp_name'], $target_dir . basename($thumb2));
    $upload3 = move_uploaded_file($_FILES['thumbnail3']['tmp_name'], $target_dir . basename($thumb3));
    $upload4 = move_uploaded_file($_FILES['thumbnail4']['tmp_name'], $target_dir . basename($thumb4));

    $q = mysqli_query($connection, "insert into tbl_product (product_name, product_price, product_thumb1, product_thumb2, product_thumb3, product_thumb4, product_details) VALUES ('{$name}', '{$price}', '{$thumb1}', '{$thumb2}', '{$thumb3}', '{$thumb4}', '{$product_details}')");

    if ($q) {
        echo "<script>alert('Product Added Successfully')</script>";
        header('location:view_product.php');
    } else {
        echo "Query Failed: " . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resource/add_style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Add New Product</h1>
            <p>Fill in the details below to create a new product listing</p>
        </div>

        <div class="form-container">
            <div class="form-tabs">
                <div class="form-tab active">Product Information</div>
            </div>

            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-content">
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-cube"></i>
                            <span>Basic Information</span>
                        </div>

                        <div class="form-group">
                            <label for="product-name">Product Name</label>
                            <input type="text" id="product-name" name="name" placeholder="Enter product name" required>
                        </div>

                        <div class="form-group">
                            <label for="product-price">Product Price</label>
                            <div class="price-input">
                                <span>$</span>
                                <input type="number" id="product-price" name="price" placeholder="0.00" min="0" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product-details">Product Details</label>
                            <textarea id="product-details" name="details" placeholder="Enter detailed product description" required></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-images"></i>
                            <span>Product Images</span>
                        </div>

                        <div class="image-upload-container">
                            <div class="upload-box">
                                <input type="file" id="thumbnail1" name="thumbnail1" accept="image/*" required>
                                <div class="upload-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Main Image</p>
                                </div>
                            </div>

                            <div class="upload-box">
                                <input type="file" id="thumbnail2" name="thumbnail2" accept="image/*">
                                <div class="upload-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Image 2</p>
                                </div>
                            </div>

                            <div class="upload-box">
                                <input type="file" id="thumbnail3" name="thumbnail3" accept="image/*">
                                <div class="upload-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Image 3</p>
                                </div>
                            </div>

                            <div class="upload-box">
                                <input type="file" id="thumbnail4" name="thumbnail4" accept="image/*">
                                <div class="upload-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Image 4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="window.location.href='view_product.php'">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </button>
                    <button type="submit" name="btn" class="submit-btn">
                        <i class="fas fa-plus"></i>
                        <span>Add Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>