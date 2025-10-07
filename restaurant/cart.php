<?php
ob_start();

include('partial/menu.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['id'])) {
    $food_id = $_GET['id'];

    $sql1 = "SELECT * FROM food WHERE id=$food_id";
    $res1 = mysqli_query($conn, $sql1);
    $food = mysqli_fetch_assoc($res1);

    if ($food) {
        $food_name = $food['title'];
        $food_price = $food['price'];
        $food_image = $food['image-name'];

        if (isset($_SESSION['cart'][$food_id])) {
            $_SESSION['cart'][$food_id]['qty']++;
        } else {
            $_SESSION['cart'][$food_id] = array(
                'name' => $food_name,
                'price' => $food_price,
                'image' => $food_image,
                'qty' => 1
            );
        }
    }
}

if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
}

if (isset($_POST['update_qty'])) {
    $food_id = $_POST['food_id'];
    $qty = intval($_POST['qty']);

    if ($qty <= 0) {
        unset($_SESSION['cart'][$food_id]);
    } else {
        $_SESSION['cart'][$food_id]['qty'] = $qty;
    }
}

if (isset($_POST['delete_all'])) {
    unset($_SESSION['cart']);
}

if (isset($_POST['place_order'])) {
    $customer_name = $_POST['name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    foreach ($_SESSION['cart'] as $food_id => $item) {
        $food_name = $item['name'];
        $price = $item['price'];
        $qty = $item['qty'];
        $total = $price * $qty;
        $order_date = date('Y-m-d H:i:s');
        $status = 'Pending';

        $sql2 = "INSERT INTO `tbl-order` (`food`, `price`, `qty`, `total`, `order-date`, `status`, `customer-name`, `customer-contact`, `customer-email`, `customer-address`)
                VALUES ('$food_name', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
        $res2 = mysqli_query($conn, $sql2);

        if (!$res2) {
            die('Error: ' . mysqli_error($conn));
        }

        $update_sql = "UPDATE food SET quantity = quantity - $qty WHERE id = $food_id";
        $update_res = mysqli_query($conn, $update_sql);

        if (!$update_res) {
            die('Error updating quantity: ' . mysqli_error($conn));
        }
    }

    unset($_SESSION['cart']);
    header('Location: index.php');
    exit;
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

</head>

<body>
    <section class="cart">
        <div class="container">
            <h2 class="text-center">Your Cart</h2>

            <?php if (!empty($_SESSION['cart'])) : ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th data-label="Image">Image</th>
                            <th data-label="Food">Food</th>
                            <th data-label="Price">Price</th>
                            <th data-label="Quantity">Quantity</th>
                            <th data-label="Total">Total</th>
                            <th data-label="Action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        foreach ($_SESSION['cart'] as $food_id => $item) :
                            $total = $item['price'] * $item['qty'];
                            $grand_total += $total;
                        ?>
                            <tr>
                                <td data-label="Image"><img src="<?php echo SITEURL; ?>images/food/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-responsive img-curve"></td>
                                <td data-label="Food"><?php echo $item['name']; ?></td>
                                <td data-label="Price">$<?php echo number_format($item['price'], 2); ?></td>
                                <td data-label="Quantity">
                                    <form action="cart.php" method="POST">
                                        <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1" required>
                                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                        <input type="submit" name="update_qty" value="Update">
                                    </form>
                                </td>
                                <td data-label="Total">$<?php echo number_format($total, 2); ?></td>
                                <td data-label="Action"><a href="cart.php?remove_id=<?php echo $food_id; ?>" class="cbuttons">Cancel</a></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="cart-cell text-right">Grand Total:</td>
                            <td>$<?php echo number_format($grand_total, 2); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="action-buttons">
                    <form action="cart.php" method="POST">
                        <input type="submit" name="delete_all" value="Delete All">
                    </form>
                    <form action="foods.php" method="get">
                        <input type="submit" value="Add More Food">
                    </form>
                </div>

                <form action="cart.php" method="POST" class="order-form">
                    <h3>Order Details</h3>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="contact">Phone Number:</label>
                    <input type="tel" id="contact" name="contact" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>

                    <input type="submit" name="place_order" value="Place Order" class="btn btn-primary">
                </form>

            <?php else : ?>
                <p>Your cart is empty.</p>
                <div style="margin-bottom: 20px;">
                    <a href="foods.php">
                        <button type="button" class="cbuttons">Add Food to Cart</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include('partial/footer.php'); ?>
</body>

</html>