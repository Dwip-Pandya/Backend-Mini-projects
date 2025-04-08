<?php
$eid = $_GET['eid'];
$connection = mysqli_connect("localhost", "root", "", "db_project1");

// Fetch user data for pre-filling the form
$q = mysqli_query($connection, "SELECT * FROM tbl_user WHERE user_id='{$eid}'");
$data = mysqli_fetch_array($q);

if ($_POST) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $current_photo = $data['user_photo']; // Fetch the current photo

    // Handle photo upload
    if (!empty($_FILES['file123']['name'])) {
        $photo =basename($_FILES['file123']['name']);
        if (move_uploaded_file($_FILES['file123']['tmp_name'], $photo)) {
            $photo_name = basename($_FILES['file123']['name']); // Save the new photo name
        } else {
            echo "File upload failed.";
            $photo_name = $current_photo; // Use the current photo if upload fails
        }
    } else {
        $photo_name = $current_photo; // Keep the current photo if no new photo is uploaded
    }

    // Update query
    $uq = mysqli_query($connection, "UPDATE tbl_user SET 
        user_fname='{$fname}', 
        user_lname='{$lname}', 
        user_number='{$number}', 
        user_email='{$email}', 
        user_password='{$password}', 
        user_photo='{$photo_name}' 
        WHERE user_id='{$eid}'");

    if ($uq) {
        header("Location: display_user.php");
    } else {
        echo "Update failed: " . mysqli_error($connection);
    }
}
?>

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
                        <input type="text" name="fname" id="fname" required value="<?php echo $data['user_fname'] ?>">
                        <label for="fname">First Name</label>
                        <span class="line"></span>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="lname" id="lname" required value="<?php echo $data['user_lname'] ?>">
                        <label for="lname">Last Name</label>
                        <span class="line"></span>
                    </div>
                </div>

                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="number" name="number" id="number" required value="<?php echo $data['user_number'] ?>">
                    <label for="number">Phone Number</label>
                    <span class="line"></span>
                </div>

                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" required value="<?php echo $data['user_email'] ?>">
                    <label for="email">Email Address</label>
                    <span class="line"></span>
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="text" name="pswd" id="pswd" required value="<?php echo $data['user_password'] ?>">
                    <label for="pswd">Password</label>
                    <span class="line"></span>
                    <i class="fas fa-eye toggle-password"></i>
                </div>

                <div class="file-upload">
                    <!-- Display current photo -->
                    <label for="current_photo">Current Photo:</label>
                    <img src="<?php echo $data['user_photo']; ?>" alt="Current Photo" width="100" height="100">

                    <!-- File input for new photo -->
                    <input type="file" name="file123" id="file123">
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