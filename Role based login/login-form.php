<?php
$connection = mysqli_connect("localhost", "root", "", "db_project2");
session_start();

if (isset($_POST['btn1'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $utype = mysqli_real_escape_string($connection, $_POST['usertype']);

    $query = mysqli_query($connection, " select * from tbl_register where user_email = '{$email}' and user_password = '{$password}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if ($row['user_type'] == 'admin') {
            $_SESSION['user'] = $row['user_name'];
            header('location:admin-page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user'] = $row['user_name'];
            header('location:user-page.php');
        } else {
            echo "Invalid User Type";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login</title>
    <link rel="stylesheet" href="resource/login-style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.162.0/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.162.0/examples/js/controls/OrbitControls.js"></script>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="avatar-section">
                <div class="avatar-wrapper">
                    <img src="resource/3d2.png" alt="3D Avatar" class="avatar-image">
                </div>
                <div class="welcome-text">
                    <h2>Welcome Back!</h2>
                    <p>Please login to continue</p>
                </div>
            </div>

            <form method="post" id="login-form" class="login-form" novalidate>
                <div class="form-group">
                    <div class="input-with-icon">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="email" id="email" name="email" placeholder="Email" required aria-describedby="emailError">
                    </div>
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Password" required aria-describedby="passwordError">
                        <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5c-7.333 0-12 6-12 6s4.667 6 12 6 12-6 12-6-4.667-6-12-6Z" />
                                <path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkbox-text">Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-button" name="btn1">
                    <span class="button-text">Login</span>
                    <svg class="button-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>

                <div class="signup-link">
                    Don't have an account? <a href="Register-form.php">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <div class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <!-- <script src="resource/login-script.js"></script> -->
</body>

</html>