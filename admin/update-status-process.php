<?php
include('../conf/connect.php');

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE `tbl-order` SET `status`='$status' WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res) {
    header('Location: manage-order.php');
} else {
    echo "<p>Failed to update status.</p>";
}
