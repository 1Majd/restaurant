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

    .btn-secondery :hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }
</style>
<div class="main-conctent">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php
        foreach (['add', 'delete', 'update', 'not-found', 'failed', 'unauthorized'] as $msg) {
            if (isset($_SESSION[$msg])) {
                echo $_SESSION[$msg];
                unset($_SESSION[$msg]);
            }
        }
        ?>
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/addfood.php" class="btn-secondery ">Add Food</a>
        <br> <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM food";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['discripton'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $image_name = $row['image-name'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"><?php echo $description; ?></textarea></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                            <?php
                            } else {
                                echo "<div class='error'>Image not Added</div>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="updatefood.php?id=<?php echo $id; ?>" class='btn-secondery'>Update Food</a>
                            <br><br>
                            <a href="deletfood.php?id=<?php echo $id; ?>&image-name=<?php echo $image_name; ?>" class="btn-secondery ">Delete Food</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>
                        <div>Food Not Added Yet.</div>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('parials/footer.php') ?>