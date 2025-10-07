<?php include('partial/menu.php'); ?>
<section class="food-search text-center">
    <div class="container">
        <?php
        if (isset($_POST['search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        } else {
            $search = '';
        }
        ?><h2>Foods on Your Search <a href="<?php echo SITEURL; ?>food-search.php?search=<?php echo urlencode($search); ?>" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php

        $sql = "SELECT f.*, c.title AS category_title 
                FROM food AS f 
                LEFT JOIN category AS c ON f.category_id = c.id 
                WHERE f.title LIKE '%$search%' 
                OR f.discripton LIKE '%$search%' 
                OR c.title LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $discripton = $row['discripton'];
                $price = $row['price'];
                $image_name = $row['image-name'];
                $category_title = $row['category_title'];
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
                        <p class="food-category">Category: <?php echo $category_title; ?></p>
                        <br>
                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food not found.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>


<?php include('partial/footer.php'); ?>