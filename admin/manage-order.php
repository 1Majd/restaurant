<?php include('parials/menu.php'); ?>
<style>
    .tbl-full {
        width: 100%;
        border-spacing: 15px;
    }

    table tr th {
        border-bottom: 10px solid black;
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
        font-weight: bold;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .btn-secondery:hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br><br>
        <div class="actions">
            <a href="export-orders.php" class="btn-secondery">Export to EXCEL</a>
            <a href="print-orders.php" class="btn-secondery">Print Orders</a>
            <a href="archive-orders.php" class="btn-secondery">Archive Orders</a>
        </div>

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Food Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            include('../conf/connect.php');

            $sql = "SELECT * FROM `tbl-order` ORDER BY `order-date` DESC";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $foodName = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $orderDate = $row['order-date'];
                        $status = $row['status'];
                        $customerName = $row['customer-name'];
                        $customerContact = $row['customer-contact'];
                        $customerEmail = $row['customer-email'];
                        $customerAddress = $row['customer-address'];
            ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($foodName); ?></td>
                            <td>$<?php echo number_format($price, 2); ?></td>
                            <td><?php echo htmlspecialchars($qty); ?></td>
                            <td>$<?php echo number_format($total, 2); ?></td>
                            <td><?php echo htmlspecialchars($orderDate); ?></td>
                            <td><?php echo htmlspecialchars($status); ?></td>
                            <td><?php echo htmlspecialchars($customerName); ?></td>
                            <td><?php echo htmlspecialchars($customerContact); ?></td>
                            <td><?php echo htmlspecialchars($customerEmail); ?></td>
                            <td><?php echo htmlspecialchars($customerAddress); ?></td>
                            <td>
                                <a href="view-order.php?id=<?php echo urlencode($id); ?>" class="btn-secondery">View Details</a>
                                <a href="update-order-status.php?id=<?php echo urlencode($id); ?>" class="btn-secondery">Change Status</a>
                                <a href="delete-order.php?id=<?php echo urlencode($id); ?>" class="btn-secondery">Delete</a>
                            </td>
                        </tr>

                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="12">No orders found.</td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="12">Failed to fetch orders.</td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>

<?php include('parials/footer.php'); ?>