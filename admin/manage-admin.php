<?php include('parials/menu.php'); ?>

<style>
    .tbl-full {
        width: 100%;
    }

    table tr th {
        border-bottom: 1px solid black;
        padding: 1%;
        text-align: left;
    }

    table tr td {
        padding: 1%;
    }

    .btn-secondery {
        padding: 1%;
        background-color: #053759;
        color: white;
        text-decoration: none;
    }

    .btn-secondery:hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br><br>

        <?php


        if (isset($_SESSION['delete'])) {
            echo "<div class='message'>{$_SESSION['delete']}</div>";
            unset($_SESSION['delete']);
        }
        ?>

        <br><br>
        <a href="add-admin.php" class="btn-secondery">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>N</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM iadmin";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full-name'];
                        $user_name = $rows['user-name'];
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/Change-password.php?id=<?php echo $id; ?>" class="btn-secondery">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondery">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delet-admin.php?id=<?php echo $id; ?>" class="btn-secondery btn-delete">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No Admins Found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Failed to retrieve admins</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('parials/footer.php'); ?>

<script src="../javascript/jquery-3.1.1.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();

            if (confirm("Are you sure you want to delete this admin?")) {
                var deleteUrl = $(this).attr('href');

                $.ajax({
                    url: deleteUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to delete Admin. Please try again later.');
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>