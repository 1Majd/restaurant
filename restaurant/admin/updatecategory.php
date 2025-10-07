<?php
ob_start();
include('parials/menu.php');
?>
<style>
    table {
        width: 30%;
    }

    table tr th {
        border-bottom: 1px solid black;
        padding: 1%;
        text-align: left;
    }

    table tr td {
        padding: 1%;
    }

    .btn-secondary {
        padding: 1%;
        background-color: #053759;
        color: white;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }
</style>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image-name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='f'>Category not found</div>";
                header("Location: " . SITEURL . 'admin/manage-categories.php');
                exit;
            }
        } else {
            header("Location: " . SITEURL . 'admin/manage-admin.php');
            exit;
        }
        ?>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            echo "<div class='f'>Image Not added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if ($featured == "yes") {
                                                                            echo "checked";
                                                                        } ?>>Yes
                        <input type="radio" name="featured" value="no" <?php if ($featured == "no") {
                                                                            echo "checked";
                                                                        } ?>>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if ($active == "yes") {
                                                                            echo "checked";
                                                                        } ?>>Yes
                        <input type="radio" name="active" value="no" <?php if ($active == "no") {
                                                                            echo "checked";
                                                                        } ?>>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "no";
            $active = isset($_POST['active']) ? $_POST['active'] : "no";

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = end(explode('.', $image_name));
                $image_name = "Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location: ' . SITEURL . 'admin/manage-categories.php');
                    exit();
                }

                if ($current_image != "") {
                    $removec_path = "../images/category/" . $current_image;
                    $removec = unlink($removec_path);
                    if ($removec == false) {
                        $_SESSION['removec'] = "<div class='error'>Failed to remove current image.</div>";
                        header('location: ' . SITEURL . 'admin/manage-categories.php');
                        exit();
                    }
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE category SET
                title = '$title',
                `image-name` = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-categories.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                header('location: ' . SITEURL . 'admin/manage-categories.php');
            }
        }
        ?>
    </div>
</div>
<?php
include('parials/footer.php');
ob_end_flush();
?>