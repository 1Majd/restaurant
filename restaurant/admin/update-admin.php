<?php include('parials/menu.php'); ?>
<div class="main_content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM iadmin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full-name'];
                    $user_name = $row['user-name'];
                } else {
                    header("Location: " . SITEURL . 'admin/manage-admin.php');
                    exit;
                }
            } else {
                header("Location: " . SITEURL . 'admin/manage-admin.php');
                exit;
            }
        } else {
            header("Location: " . SITEURL . 'admin/manage-admin.php');
            exit;
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="user_name" placeholder="Enter Your UserName" value="<?php echo $user_name; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondery ">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];

    $sql = "UPDATE iadmin SET `full-name`='$full_name', `user-name`='$user_name' WHERE id=$id";
    $res = mysqli_query($con, $sql);

    if ($res == true) {
        header("Location: " . SITEURL . 'admin/manage-admin.php');
        exit;
    } else {
        echo "Failed to update admin. <a href='" . SITEURL . "admin/manage-admin.php'>Go back</a>";
    }
}
?>
<?php include('parials/footer.php') ?>