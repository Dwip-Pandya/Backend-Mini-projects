<?php
session_start();
// Database connection
$connect = mysqli_connect("localhost", "root", "", "db_quickkart");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch categories from `tbl_category`
$category_query = "SELECT * FROM tbl_category";
$category_result = mysqli_query($connect, $category_query);

// Handle form submission
if (isset($_POST['submit'])) {
    $subcat_name = $_POST['subcat_name'];
    $category_id = $_POST['category_id'];

    $insert_query = "INSERT INTO tbl_subcategory (subcat_name, category_id) VALUES ('$subcat_name', '$category_id')";
    if (mysqli_query($connect, $insert_query)) {
        echo "<script>alert('Subcategory added successfully!');</script>";
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
    <title>Add Subcategory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Subcategory</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Subcategory Name:</label>
                <input type="text" name="subcat_name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Select Category:</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($category_result)) {
                        echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Subcategory</button>
        </form>
    </div>
</body>
</html>
