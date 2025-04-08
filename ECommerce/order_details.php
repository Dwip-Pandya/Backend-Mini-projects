<?php
session_start();
include("connection.php"); // Database connection

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['uid'];

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Validate and get order ID
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    echo "Invalid order.";
    exit();
}


// Fetch order details
$sql = "SELECT tbl_orders.order_id, tbl_orders.order_date, tbl_orders.total_amount, tbl_orders.order_status, 
               tbl_order_items.order_item_id, tbl_order_items.product_id, tbl_products.product_name, 
               tbl_order_items.quantity, tbl_order_items.price
        FROM tbl_orders
        JOIN tbl_order_items ON tbl_orders.order_id = tbl_order_items.order_id
        JOIN tbl_products ON tbl_order_items.product_id = tbl_products.product_id
        WHERE tbl_orders.order_id = ? AND tbl_orders.user_id = ?";


$stmt = $connect->prepare($sql);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows === 0) {
    echo "Order not found.";
    exit();
}

// Fetch data
$order_data = [];
while ($row = $result->fetch_assoc()) {
    $order_data[] = $row;
}

// Close statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - My Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css"> 
    <link rel="stylesheet" href="css/orders.css"> 
</head>

<body>
<?php
    include 'theme-parts/header.php';
    ?>

    <h2>Order Details</h2>
    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order_data[0]['order_date']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order_data[0]['order_status']); ?></p>

    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (each)</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            foreach ($order_data as $item) {
                $total_price = $item['quantity'] * $item['price'];
                $grand_total += $total_price;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo number_format($total_price, 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Grand Total:</strong></td>
                <td><strong><?php echo number_format($grand_total, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <br>
    <a href="my_orders.php">Back to My Orders</a><br>
    <p></p>
    <?php
    include 'theme-parts/footer.php';
    ?>

</body>

</html>