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
<div class="main-conctent">
    <div class="wrapper">
        <h1>Manage Categories</h1>
        <br> <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['removec'])) {
            echo $_SESSION['removec'];
            unset($_SESSION['removec']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <a href="add-categories.php" class="btn-secondary  ">Add Categories</a>
        <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image-name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php

                            if ($image_name != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                            <?php

                            } else {
                                echo "<div class='error'>Image not Added</div>";
                            }

                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/updatecategory.php?id=<?php echo $id; ?>" class="btn-secondary  ">Update Categories</a><br><br>
                            <a href="<?php echo SITEURL; ?>admin/delet-category.php?id=<?php echo $id; ?>&image-name=<?php echo $image_name; ?>" class="btn-secondary ">Delete Categories</a>
                        </td>
                    </tr>
                <?php

                }
            } else {
                ?>

                <tr>
                    <td colspan="6">
                        <div>No Category Added.</div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>


<?php include('parials/footer.php') ?>