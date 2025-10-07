<?php
include('conf/connect.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT title FROM category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } else {
        echo "Failed to execute query: " . mysqli_error($conn);
        exit();
    }
} else {
    header('location:' . SITEURL . 'foods.php');
    exit();
}

include('partial/menu.php');
?>

<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $category_id; ?>" class="text-white">"<?php echo isset($category_title) ? $category_title : ''; ?>"</a></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM food WHERE category_id=$category_id";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['discripton'];
                    $price = $row2['price'];
                    $image_name = $row2['image-name'];
        ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if (!empty($image_name)) {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php
                            } else {
                                echo "<div class='error'>Image not Added</div>";
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>
                            <a href="<?php echo SITEURL; ?>cart.php?id=<?php echo $id ?>" class="btn btn-primary">Add To Cart</a>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "<div class='error'>Food not found.</div>";
            }
        } else {
            echo "Failed to execute query: " . mysqli_error($conn);
            exit();
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partial/footer.php'); ?>