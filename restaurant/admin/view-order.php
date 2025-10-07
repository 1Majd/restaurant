<?php include('parials/menu.php'); ?>
<style>
    .order-details {
        margin: 2rem;
    }

    .order-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-details th,
    .order-details td {
        padding: 1rem;
        border: 1px solid #ddd;
        text-align: left;
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

<div class="main-content">
    <div class="wrapper">
        <h1>Order Details</h1>

        <?php

        $id = $_GET['id'];


        $sql = "SELECT * FROM `tbl-order` WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $order = mysqli_fetch_assoc($res);
            if ($order) {
        ?>

                <div class="order-details">
                    <table>
                        <tr>
                            <th>Food Name</th>
                            <td><?php echo $order['food']; ?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>$<?php echo $order['price']; ?></td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td><?php echo $order['qty']; ?></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>$<?php echo number_format($order['total'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td><?php echo $order['order-date']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $order['status']; ?></td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td><?php echo $order['customer-name']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><?php echo $order['customer-contact']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $order['customer-email']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $order['customer-address']; ?></td>
                        </tr>
                    </table>
                </div>

                <a href="manage-order.php" class="btn-secondery">Back to Orders</a>

        <?php
            } else {
                echo "<p>Order not found.</p>";
            }
        } else {
            echo "<p>Error fetching order details.</p>";
        }
        ?>
    </div>
</div>

<?php include('parials/footer.php'); ?>