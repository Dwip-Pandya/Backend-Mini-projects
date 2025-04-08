<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="resource/style2.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <div class="title-section">
                <h1>User Management</h1>
                <p class="subtitle">Manage and track your users</p>
            </div>
            <a href="add_user.php" class="add-user-btn">
                <i class="fas fa-user-plus"></i>
                <span>Add New User</span>
            </a>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="record-count">
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "db_project1");
                    $q = mysqli_query($connection, "select * from tbl_user");
                    $count = mysqli_num_rows($q);
                    echo "<i class='fas fa-users'></i> <span>{$count} Users Found</span>";
                    ?>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search users...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($q)) {
                            echo "<tr>";
                            echo "<td><span class='id-badge'>#{$data[0]}</span></td>";
                            echo "<td><div class='profile-image'><img src='{$data[6]}' alt='Profile'></div></td>";
                            echo "<td>{$data[1]}</td>";
                            echo "<td>{$data[2]}</td>";
                            echo "<td>{$data[3]}</td>";
                            echo "<td><a href='mailto:{$data[4]}' class='email-link'>{$data[4]}</a></td>";
                            echo "<td>{$data[5]}</td>";
                            echo "<td>
                            <a href='edit_user.php?eid={$data['user_id']};' class='action-link'>
                            <img style='width: 30px;' src='resource/edit.png'>&nbsp;</a> 
                            | 
                            <a href='delete_user.php?did={$data['user_id']};' class='action-link'>
                            <img style='width: 30px;' src='resource/delete.png'>&nbsp;</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="resource/script2.js"></script>
</body>
</html>