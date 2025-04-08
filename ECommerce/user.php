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
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/user.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card signup-card">
                    <div class="card-header text-center">
                        <h2>Create Account</h2>
                        <p>Sign up to get started</p>
                    </div>
                    <div class="card-body">
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
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength mt-2">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small class="form-text">Password strength: <span id="password-strength-text">None</span></small>
                                </div>
                            </div>

                            <button name="btn1" type="submit" class="btn btn-primary w-100 signup-btn">
                                Sign Up <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p class="mb-0">Already have an account? <a href="login.php" class="login-link">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        // Simple password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const progressBar = document.querySelector('.progress-bar');
            const strengthText = document.getElementById('password-strength-text');

            let strength = 0;
            if (password.length >= 8) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^A-Za-z0-9]/)) strength += 25;

            progressBar.style.width = strength + '%';

            if (strength <= 25) {
                progressBar.className = 'progress-bar bg-danger';
                strengthText.textContent = 'Weak';
            } else if (strength <= 50) {
                progressBar.className = 'progress-bar bg-warning';
                strengthText.textContent = 'Medium';
            } else if (strength <= 75) {
                progressBar.className = 'progress-bar bg-info';
                strengthText.textContent = 'Good';
            } else {
                progressBar.className = 'progress-bar bg-success';
                strengthText.textContent = 'Strong';
            }
        });
    </script>
</body>

</html>