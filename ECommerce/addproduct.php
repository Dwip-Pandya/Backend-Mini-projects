<?php
session_start();
include 'connection.php';

// Fetch categories
$category_query = "SELECT * FROM tbl_category";
$category_result = mysqli_query($connect, $category_query);

// Fetch subcategories
$subcategory_query = "SELECT * FROM tbl_subcategory";
$subcategory_result = mysqli_query($connect, $subcategory_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $price = mysqli_real_escape_string($connect, $_POST['price']);
    $stock_quantity = mysqli_real_escape_string($connect, $_POST['stock_quantity']);
    $category_id = mysqli_real_escape_string($connect, $_POST['category_id']);
    $subcat_id = mysqli_real_escape_string($connect, $_POST['subcat_id']);
    $product_point1 = mysqli_real_escape_string($connect, $_POST['porduct_point1']);
    $product_point2 = mysqli_real_escape_string($connect, $_POST['porduct_point2']);
    $product_point3 = mysqli_real_escape_string($connect, $_POST['porduct_point3']);
    $product_point4 = mysqli_real_escape_string($connect, $_POST['porduct_point4']);
    

    $target_dir = "uploads/";
    $image1 = $target_dir . basename($_FILES["image1"]["name"]);
    $image2 = $target_dir . basename($_FILES["image2"]["name"]);
    $image3 = $target_dir . basename($_FILES["image3"]["name"]);
    $image4 = $target_dir . basename($_FILES["image4"]["name"]);

    move_uploaded_file($_FILES["image1"]["tmp_name"], $image1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $image2);
    move_uploaded_file($_FILES["image3"]["tmp_name"], $image3);
    move_uploaded_file($_FILES["image4"]["tmp_name"], $image4);

    $query = "INSERT INTO tbl_products (product_name, description, price, stock_quantity, category_id, subcat_id, image1, image2, image3, image4, porduct_point1, porduct_point2, porduct_point3, porduct_point4) 
              VALUES ('$product_name', '$description', '$price', '$stock_quantity', '$category_id', '$subcat_id', '$image1', '$image2', '$image3', '$image4','$product_point1', '$product_point2', '$product_point3', '$product_point4')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/addproduct.css">
</head>

<body>
    <h2>Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="product_name" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Detail 1</label>
        <input type="text" name="porduct_point1" required><br>

        <label>Detail 2</label>
        <input type="text" name="porduct_point2" required><br>

        <label>Detail 3</label>
        <input type="text" name="porduct_point3" required><br>

        <label>Detail 4</label>
        <input type="text" name="porduct_point4" required><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" required><br>

        <label>Category:</label>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while ($row = mysqli_fetch_assoc($category_result)) : ?>
                <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label>Subcategory:</label>
        <select name="subcat_id" required>
            <option value="">Select Subcategory</option>
            <?php while ($row = mysqli_fetch_assoc($subcategory_result)) : ?>
                <option value="<?= $row['subcat_id'] ?>"><?= $row['subcat_name'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label>Upload Image 1:</label>
        <input type="file" name="image1" required><br>

        <label>Upload Image 2:</label>
        <input type="file" name="image2" required><br>

        <label>Upload Image 3:</label>
        <input type="file" name="image3" required><br>

        <label>Upload Image 4:</label>
        <input type="file" name="image4" required><br>

        <button type="submit">Add Product</button>
    </form>
</body>

</html>
