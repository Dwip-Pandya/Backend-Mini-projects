<?php
session_start();
include 'connection.php';
if (isset($_POST['btn1'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = mysqli_query($connect, "select * from tbl_user where user_email = '{$email}' and user_password = '{$password}'");
    $data = mysqli_fetch_array($q);
    $count = mysqli_num_rows($q);
    if ($count > 0) {
        $_SESSION['uid'] = $data['user_id'];
        $_SESSION['uname'] = $data['user_name'];
        header("location:index.php");
    } else {
        echo "<script>alert('Login Failed')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include('theme-parts/header.php');
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="card-header text-center">
                        <h2>Welcome Back</h2>
                        <p>Login to your account</p>
                    </div>
                    <div class="card-body">
                        <form method="post" id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email Address
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="forgot-password">Forgot password?</a>
                            </div>

                            <button name="btn1" type="submit" class="btn btn-primary w-100 login-btn">
                                Login <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p class="mb-0">Don't have an account? <a href="user.php" class="signup-link">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('theme-parts/footer.php');
    ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>