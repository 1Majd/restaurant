<?php
include('../conf/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM iadmin WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "Admin Deleted Successfully";
        echo json_encode(array("status" => "success", "message" => "Admin Deleted Successfully"));
    } else {
        $_SESSION['delete'] = "Failed to delete Admin. Please try again later.";
        echo json_encode(array("status" => "error", "message" => "Failed to delete Admin. Please try again later."));
    }
} else {
    $_SESSION['delete'] = "Invalid ID";
    echo json_encode(array("status" => "error", "message" => "Invalid ID"));
}
