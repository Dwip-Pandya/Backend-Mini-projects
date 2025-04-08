<?php

$did = $_GET['did'];
include 'connect.php';
$q = mysqli_query($connection, "delete from tbl_product where product_id='{$did}'");
if ($q) {
    header("location:view_products.php");
}
