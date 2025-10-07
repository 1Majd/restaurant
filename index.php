<?php include('partial/menu.php'); ?>
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        $sql1 = "SELECT * FROM category WHERE active='yes' AND featured='yes'";
        $res1 = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($res1);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res1)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image-name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>Category No Added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM food WHERE quantity > 0";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $discripton = $row['discripton'];
                $price = $row['price'];
                $image_name = $row['image-name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name != "") {
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
                        <p class="food-detail"><?php echo $discripton; ?></p>
                        <br>
                        <a href="<?php echo SITEURL; ?>cart.php?id=<?php echo $id ?>" class="btn btn-primary">Add To Cart</a>

                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food No Added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>


<?php include('partial/footer.php'); ?>