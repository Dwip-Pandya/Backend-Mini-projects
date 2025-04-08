<?php
session_start();
include 'connection.php';
if (isset($_POST['btn1'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($connect, "insert into tbl_user (user_name, user_email, user_password) values ('$username', '$email', '$password')") or die(mysqli_error($connect));
    if ($query) {
        echo "<script>alert('You have successfully registered.')</script>";
    } else {
        echo "<script>alert('Registration failed.')</script>";
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
                <div class="form" border="2" style="border: 2px solid #1f3e68;  border-radius: 10px; padding: 20px; background-color:#f8f9fa;">
                    <div class="registration-container">
                        <h3 class="text-center mb-4">User Registration</h3>
                        <form method="post" id="signupForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user"></i> Username
                                </label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email Address
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Create a password" required>
                                </div>
                            </div>

                            <button name="btn1" type="submit" class="btn btn-primary w-100 signup-btn">
                                Add user <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </form>
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