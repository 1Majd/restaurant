<?php include('parials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="Full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="UserName" placeholder="Enter Your UserName"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="Password" name="Password" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondery">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('parials/footer.php') ?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Full_name']) && isset($_POST['UserName']) && isset($_POST['Password'])) {
        $full_name = $_POST['Full_name'];
        $user_name = $_POST['UserName'];
        $password = md5($_POST['Password']);

        $sql = "INSERT INTO iadmin (`full-name`, `user-name`, `password`) VALUES ('$full_name', '$user_name', '$password')";

        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['add'] = "Admin Add Successfulyy";
            header("location: " . SITEURL . 'admin/manage-admin.php');
        } else {
            $_SESSION['add'] = "Failed to Add admin";
            header("location: " . SITEURL . 'admin/add-admin.php');
        }
    }
}
?>