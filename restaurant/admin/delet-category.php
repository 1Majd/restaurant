<?php
include('../conf/connect.php');
session_start();

if (isset($_GET['id']) && isset($_GET['image-name'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $image_name = mysqli_real_escape_string($conn, $_GET['image-name']);

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        if (file_exists($path)) {
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
                header('location: ' . SITEURL . 'admin/manage-categories.php');
                exit();
            }
        } else {
            $_SESSION['remove'] = "<div class='error'>Image file does not exist</div>";
            header('location: ' . SITEURL . 'admin/manage-categories.php');
            exit();
        }
    }
    $sql = "DELETE FROM category WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category. Try again later</div>";
    }
    mysqli_stmt_close($stmt);
    header('location:' . SITEURL . 'admin/manage-categories.php');
} else {
    header('location:' . SITEURL . 'admin/manage-categories.php');
}
