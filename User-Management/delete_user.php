<?php

$did = $_GET['did'];
$connection = mysqli_connect("localhost", "root", "", "db_project1");
$q = mysqli_query($connection, "delete from tbl_user where user_id='{$did}'");
if ($q) {
    header("location:display_user.php");
}
