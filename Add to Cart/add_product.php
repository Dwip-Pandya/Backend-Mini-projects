<?php
include 'connect.php';
$message = '';

if (isset($_POST['btn1'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploads/' . $product_image;

    $q = mysqli_query($connection, "INSERT INTO tbl_product (product_name, product_price, product_image) VALUES ('{$product_name}','{$product_price}','{$product_image}')") or die(mysqli_error($connection));

    if ($q) {
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $message = "<div class='success-message'>Product '{$product_name}' added successfully!</div>";
    } else {
        $message = "<div class='error-message'>Failed to add product. Please try again.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - ShopKart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/add_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include 'theme-part/header.php';
    ?>
    <main>
        <div class="container">
            <div class="page-header">
                <h2>Add New Product</h2>
                <p>Fill in the details below to add a new product to your inventory</p>
            </div>

            <?php
            if (!empty($message)) {
                echo $message;
            }
            ?>

            <div class="form-container">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" required placeholder="Enter product name">
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price ($)</label>
                        <input type="number" id="product_price" name="product_price" step="0.01" min="0" required placeholder="Enter product price">
                    </div>

                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <div class="file-input-container">
                            <input type="file" id="product_image" name="product_image" accept="image/*" required>
                            <div class="file-input-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Choose an image</span>
                            </div>
                        </div>
                        <div class="file-name">No file chosen</div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn-secondary">Reset</button>
                        <button type="submit" class="btn-primary" name="btn1">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    include 'theme-part/footer.php';
    ?>
</body>

</html>