<?php
include('parials/menu.php');

if (isset($_POST['submit'])) {

    $title =  $_POST['title'];
    $description =  $_POST['description'];
    $price = $_POST['price'];
    $category =  $_POST['category'];
    $quantity = $_POST['quantity'];
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $ext = explode('.', $image_name);
        $file_ext = end($ext);
        $image_name = "Food_Name_" . rand(000, 999) . '.' . $file_ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;
        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
            header('location:' . SITEURL . 'admin/addfood.php');
            exit();
        }
    } else {
        $image_name = "";
    }
    $sql2 = "INSERT INTO food (title, discripton, price, `image-name`, category_id, quantity) VALUES ('$title', '$description', $price, '$image_name', $category, $quantity)";


    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-foods.php');
        exit();
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
        header('location:' . SITEURL . 'admin/addfood.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Food</title>

</head>

<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>

            <br><br>
            <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>

            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Title of the food" required></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" placeholder="Price" required></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category" required>
                                <?php
                                $sql1 = "SELECT * FROM category WHERE active = 'yes'";
                                $res1 = mysqli_query($conn, $sql1);

                                if (mysqli_num_rows($res1) > 0) {
                                    while ($row = mysqli_fetch_assoc($res1)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$id'>$title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>No Category Found</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="quantity" placeholder="Quantity of Food" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondery">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include('parials/footer.php'); ?>
</body>

</html>