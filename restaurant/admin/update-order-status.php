<?php include('parials/menu.php'); ?>
<style>
    .order-status-form {
        margin: 2rem;
    }

    .order-status-form input,
    .order-status-form select {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
    }

    .order-status-form input[type="submit"] {
        background-color: #053759;
        color: white;
        border: none;
        padding: 1rem;
        cursor: pointer;
    }

    .order-status-form input[type="submit"]:hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order Status</h1>

        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM `tbl-order` WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $order = mysqli_fetch_assoc($res);

        if ($order) {
        ?>

            <div class="order-status-form">
                <form action="update-status-process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="status">Order Status:</label>
                    <select name="status" id="status">
                        <option value="Pending" <?php echo ($order['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Shipped" <?php echo ($order['status'] == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                        <option value="Delivered" <?php echo ($order['status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                        <option value="Canceled" <?php echo ($order['status'] == 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                    </select>
                    <input type="submit" value="Update Status">
                </form>
            </div>

        <?php
        } else {
            echo "<p>Order not found.</p>";
        }
        ?>
    </div>
</div>

<?php include('parials/footer.php'); ?>