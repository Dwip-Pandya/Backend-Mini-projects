<?php
session_start();
// payment_page.php
include('connection.php');

// Get the order ID from the URL or session
$order_id = $_GET['order_id']; // e.g., payment_page.php?order_id=101

// Fetch total amount from tbl_orders
$sql = "SELECT total_amount FROM tbl_orders WHERE order_id = $order_id";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $amount = $row['total_amount'];
} else {
    die("Order not found.");
}
$connect->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Payment</title>
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
    <link rel="stylesheet" href="css/payment-page.css">
    <style>
        /* payment-page.css */

        /* Main Container Styling */
        .payment-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Page Header */
        .payment-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .payment-header h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .payment-header p {
            color: #666;
            font-size: 16px;
        }

        /* Order Summary */
        .order-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .order-summary h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .order-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px dashed #ddd;
            font-weight: 600;
            font-size: 18px;
            color: #333;
        }

        /* Payment Button */
        #pay-btn {
            background-color: #1a365d;
            color: white;
            padding: 14px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #pay-btn:hover {
            background-color: #1a365d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #pay-btn:active {
            transform: translateY(0);
        }

        /* Security Badge */
        .security-badge {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .security-badge i {
            color: #1a365d;
            margin-right: 5px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .payment-container {
                padding: 20px;
                margin: 20px 15px;
            }
        }

        /* Loading spinner for payment processing */
        .spinner {
            display: none;
            margin: 0 auto;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #1a365d;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Payment methods section */
        .payment-methods {
            margin-bottom: 20px;
            text-align: center;
        }

        .payment-methods img {
            height: 30px;
            margin: 0 5px;
            opacity: 0.7;
        }

        /* Success animation elements */
        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            stroke-width: 6;
            stroke: #4CAF50;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #1a365d;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            display: none;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 6;
            stroke-miterlimit: 10;
            stroke: #4CAF50;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #4CAF50;
            }
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <?php include('theme-parts/header.php'); ?>

    <div class="container">
        <div class="payment-container">
            <div class="payment-header">
                <h2>Complete Your Payment</h2>
                <p>Order #<?php echo $order_id; ?></p>
            </div>

            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="order-detail">
                    <span>Order Total</span>
                    <span>₹<?php echo number_format($amount, 2); ?></span>
                </div>
                <div class="order-detail">
                    <span>Taxes</span>
                    <span>Included</span>
                </div>
                <div class="order-total">
                    <span>Total</span>
                    <span>₹<?php echo number_format($amount, 2); ?></span>
                </div>
            </div>

            <div class="payment-methods">
                <span>Secured Payment via</span><br>
                <img src="images/razorpay-logo.png" alt="Razorpay" title="Razorpay">
            </div>

            <form id="paymentForm">
                <input type="hidden" id="amount" value="<?php echo $amount; ?>">
                <input type="hidden" id="order_id" value="<?php echo $order_id; ?>">
                <button type="button" id="pay-btn">
                    <i class="bi bi-credit-card me-2"></i>Pay ₹<?php echo number_format($amount, 2); ?>
                </button>
            </form>

            <div class="spinner" id="loading-spinner"></div>

            <!-- Success animation (initially hidden) -->
            <svg class="checkmark" id="success-animation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>

            <div class="security-badge">
                <i class="bi bi-shield-check"></i> Your payment is secure and encrypted
            </div>
        </div>
    </div>

    <?php include('theme-parts/footer.php'); ?>

    <script>
        document.getElementById('pay-btn').onclick = function(e) {
            const amount = document.getElementById('amount').value;
            const orderId = document.getElementById('order_id').value;

            // Show loading spinner
            document.getElementById('loading-spinner').style.display = 'block';
            document.getElementById('pay-btn').disabled = true;
            document.getElementById('pay-btn').innerHTML = 'Processing...';

            fetch('create_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        amount: amount,
                        order_id: orderId
                    })
                })
                .then(res => res.json())
                .then(order => {
                    // Hide loading spinner
                    document.getElementById('loading-spinner').style.display = 'none';
                    document.getElementById('pay-btn').disabled = false;
                    document.getElementById('pay-btn').innerHTML = '<i class="bi bi-credit-card me-2"></i>Pay ₹' + parseFloat(amount).toFixed(2);

                    if (order.error) {
                        console.error("Order creation failed:", order.error);
                        alert("Failed to create order: " + order.error);
                        return;
                    }

                    const options = {
                        "key": "your key",
                        "amount": order.amount,
                        "currency": "INR",
                        "name": "QuickKart",
                        "description": "Payment for Order #" + order.order_ref,
                        "order_id": order.id,
                        "handler": function(response) {
                            console.log("Payment successful", response);

                            // Show success animation
                            document.getElementById('paymentForm').style.display = 'none';
                            document.getElementById('success-animation').style.display = 'block';

                            // Redirect to thank you page after 2 seconds
                            setTimeout(function() {
                                window.location.href = "thankyou.php?order_id=" + orderId + "&payment_id=" + response.razorpay_payment_id;
                            }, 2000);
                        },
                        "prefill": {
                            "name": "Customer Name",
                            "email": "customer@example.com"
                        },
                        "theme": {
                            "color": "#4CAF50"
                        }
                    };
                    const rzp = new Razorpay(options);
                    rzp.open();
                })
                .catch(err => {
                    // Hide loading spinner
                    document.getElementById('loading-spinner').style.display = 'none';
                    document.getElementById('pay-btn').disabled = false;
                    document.getElementById('pay-btn').innerHTML = '<i class="bi bi-credit-card me-2"></i>Pay ₹' + parseFloat(amount).toFixed(2);

                    console.error("Fetch error:", err);
                    alert("Failed to create order. Please try again.");
                });
            e.preventDefault();
        };
    </script>

</body>

</html>
