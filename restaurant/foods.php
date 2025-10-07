<?php include('partial/menu.php'); ?>

<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        $sql = "SELECT * FROM food ";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $discripton = $row['discripton'];
                $price = $row['price'];
                $image_name = $row['image-name'];
                $quantity = $row['quantity'];
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
                        <?php if ($quantity > 0) { ?>
                            <a href="<?php echo SITEURL; ?>cart.php?id=<?php echo $id ?>" class="btn btn-primary">Add To Cart</a>
                        <?php } else { ?>
                            <p class="food-unavailable">Food Not Available</p>
                        <?php } ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food Not Added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partial/footer.php'); ?>