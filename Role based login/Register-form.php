<?php
$connection = mysqli_connect("localhost", "root", "", "db_project2");
session_start();

if (isset($_POST['btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $utype = mysqli_real_escape_string($connection, $_POST['usertype']);

    $q = mysqli_query($connection, "INSERT INTO tbl_register (user_name, user_email, user_password, user_type) VALUES ('{$name}', '{$email}', '{$password}', '{$utype}')");

    if ($q) {
        echo "Registration Successful";
        header('location:login-form.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Registration</title>
    <link rel="stylesheet" href="resource/register-style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.162.0/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.162.0/examples/js/controls/OrbitControls.js"></script>
</head>

<body>
    <div class="container">
        <div class="registration-wrapper">
            <div class="left-section">
                <h1>Register Now</h1>
                <div id="avatar-container">
                    <img src="resource/3d2.png" alt="3D Registration Image">
                </div>

            </div>

            <form method="post" id="registration-form" class="registration-form" novalidate>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="name" required pattern="[A-Za-z\s]{2,50}"
                        aria-describedby="fullNameError">
                    <span class="error-message" id="fullNameError"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required aria-describedby="emailError">
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required minlength="8"
                            aria-describedby="passwordError">
                        <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5c-7.333 0-12 6-12 6s4.667 6 12 6 12-6 12-6-4.667-6-12-6Z" />
                                <path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill"></div>
                        </div>
                        <span class="strength-text"></span>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="password-input">
                        <input type="password" id="cpassword" name="confirmPassword" required
                            aria-describedby="confirmPasswordError">
                        <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5c-7.333 0-12 6-12 6s4.667 6 12 6 12-6 12-6-4.667-6-12-6Z" />
                                <path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-message" id="confirmPasswordError"></span>
                </div>

                <div class="form-group">
                    <label for="userType">User Type</label>
                    <select id="userType" name="usertype" required>
                        <option value="guest">Guest</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <input type="submit" class="submit-button" name="btn" value="Register"></input><br><br>
                already have an account? <a href="login-form.php">Login</a>
            </form>
        </div>
    </div>

    <div class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <script src="resource/register-script.js"></script>
</body>

</html>