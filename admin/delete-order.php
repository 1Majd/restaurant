<?php

include('../conf/connect.php');

$id = $_GET['id'];


if (isset($id) && is_numeric($id)) {

    $sql = "DELETE FROM `tbl-order` WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res) {

        $_SESSION['message'] = 'Order deleted successfully.';
    } else {
        $_SESSION['message'] = 'Failed to delete order.';
    }
} else {
    $_SESSION['message'] = 'Invalid order ID.';
}

header('Location: manage-order.php');
exit;
