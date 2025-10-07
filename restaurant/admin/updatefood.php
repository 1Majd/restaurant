<?php
include('../conf/connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['discripton'];
            $price = $row['price'];
            $image_name_old = $row['image-name'];
            $category_id = $row['category_id'];
            $quantity = $row['quantity'];
        } else {
            $_SESSION['not-found'] = "<div class='error'>Food item not found.</div>";
            header('location:' . SITEURL . 'admin/manage-foods.php');
            exit();
        }
    } else {
        $_SESSION['failed'] = "<div class='error'>Failed to fetch food details.</div>";
        header('location:' . SITEURL . 'admin/manage-foods.php');
        exit();
    }
} else {
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-foods.php');
    exit();
}
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity =  $_POST['quantity'];
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
            header('location:' . SITEURL . 'admin/updatefood.php?id=' . $id);
            die();
        }

        if ($image_name_old != "") {
            $path = "../images/food/" . $image_name_old;
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to remove old image.</div>";
                header('location:' . SITEURL . 'admin/updatefood.php?id=' . $id);
                die();
            }
        }
    } else {
        $image_name = $image_name_old;
    }
    $sql2 = "UPDATE food SET
        title = '$title',
        discripton = '$description',
        price = $price,
        `image-name` = '$image_name',
        category_id = $category,
quantity = '$quantity'
        WHERE id = $id
    ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-foods.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
        header('location:' . SITEURL . 'admin/updatefood.php?id=' . $id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .wrapper {
            padding: 1%;
            width: 80%;
            margin: 0 auto;
        }

        .main-content {
            background-color: #f1f2f0;
            padding: 3% 0;
        }

        table {
            width: 50%;
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

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>
            <?php
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" required><?php echo $description; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" placeholder="Price" value="<?php echo $price; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td><?php if ($image_name_old != "") {
                                echo "<img src='../images/food/$image_name_old' width='100px'>";
                            } else {
                                echo "No image";
                            } ?></td>
                    </tr>
                    <tr>
                        <td>Select New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                $sql1 = "SELECT * FROM category WHERE active = 'yes'";
                                $res1 = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_assoc($res1)) {
                                    $cat_id = $row['id'];
                                    $cat_title = $row['title'];
                                    echo "<option value='$cat_id'" . ($cat_id == $category_id ? ' selected' : '') . ">$cat_title</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary ">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>