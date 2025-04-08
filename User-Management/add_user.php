<?php
$connection = mysqli_connect("localhost", "root", "", "db_project1");
if (isset($_POST['btn1'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $photo = $_FILES['file123']['name'];

    $q = mysqli_query($connection, "insert into tbl_user (user_fname,user_lname,user_number,user_email, user_password, user_photo) values ('{$fname}','{$lname}','{$number}','{$email}', '{$password}', '{$photo}')");


    if ($q) {
        move_uploaded_file($_FILES['file123']['tmp_name'], $photo);
        echo "<script>alert('Record Added to your Database')</script>";
        header('location:display_user.php');
    } else {
        echo "<script>alert('Error')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="resource/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Create Account</h1>
            <p class="subtitle">Join our community today</p>
            
            <form method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="fname" id="fname" required>
                        <label for="fname">First Name</label>
                        <span class="line"></span>
                    </div>
                    
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="lname" id="lname" required>
                        <label for="lname">Last Name</label>
                        <span class="line"></span>
                    </div>
                </div>

                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="number" name="number" id="number" required>
                    <label for="number">Phone Number</label>
                    <span class="line"></span>
                </div>

                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email Address</label>
                    <span class="line"></span>
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pswd" id="pswd" required>
                    <label for="pswd">Password</label>
                    <span class="line"></span>
                    <i class="fas fa-eye toggle-password"></i>
                </div>

                <div class="file-upload">
                    <input type="file" name="file123" id="file123" required>
                    <label for="file123">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Choose Profile Picture</span>
                    </label>
                    <div class="file-preview"></div>
                </div>

                <button type="submit" name="btn1" class="submit-btn">
                    <span>Create Account</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>