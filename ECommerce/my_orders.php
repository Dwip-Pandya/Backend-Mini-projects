<?php
session_start();
require 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];

// Fetch user orders
$sql = "SELECT * FROM tbl_orders WHERE user_id = ? ORDER BY order_date  ASC";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - My Orders</title>
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

    <h2>My Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $order['order_id']; ?></td>
                    <td><?php echo date("d M Y, H:i", strtotime($order['order_date'])); ?></td>
                    <td>&#8377;<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td><?php echo ucfirst($order['order_status']); ?></td>
                    <td>
                        <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>">View</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php
    include 'theme-parts/footer.php';
    ?>

</body>

</html>
<?php
$stmt->close();
$connect->close();
?>