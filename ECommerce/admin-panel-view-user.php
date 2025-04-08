<?php
include 'connection.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT user_id, user_name, user_email, user_password FROM tbl_user WHERE user_name LIKE ? OR user_email LIKE ?";
$stmt = $connect->prepare($query);
$searchParam = "%$search%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="css/admin-styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <div class="col-10 main-content">
                <?php include 'header.php'; ?>
                <div class="form">
                    <div class="users-table-container">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0"><i class="fas fa-users me-2"></i>User Management</h3>
                                    <div class="input-group search-group">
                                        <input type="text" class="form-control" placeholder="Search users..." id="searchInput">
                                        <button class="btn btn-primary" type="button" id="searchButton">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover user-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th><i class="fas fa-user me-1"></i> Username</th>
                                                <th><i class="fas fa-envelope me-1"></i> Email</th>
                                                <th><i class="fas fa-cog me-1"></i> Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT user_id, user_name, user_email FROM tbl_user";
                                            $result = mysqli_query($connect, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['user_id'] . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                                                    echo "<td>
                                                            <div class='btn-group btn-group-sm'>
                                                                <button type='button' class='btn btn-info'><i class='fas fa-edit'></i></button>
                                                                <button type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                                                                <button type='button' class='btn btn-secondary'><i class='fas fa-lock'></i></button>
                                                            </div>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center'>No users found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>