<?php include('parials/menu.php'); ?>
<style>
    .tbl-full {
        width: 100%;
    }

    table tr th {
        border-bottom: 1px solid black;
        padding: 1%;
        text-align: left;
    }

    table tr td {
        padding: 1%;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Archived Orders</h1>

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
            </tr>

            <?php
            $sql = "SELECT * FROM `tbl-order` ORDER BY `order-date` DESC";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $row['food']; ?></td>
                            <td>$<?php echo $row['price']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td>$<?php echo number_format($row['total'], 2); ?></td>
                            <td><?php echo $row['order-date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['customer-name']; ?></td>
                            <td><?php echo $row['customer-contact']; ?></td>
                            <td><?php echo $row['customer-email']; ?></td>
                            <td><?php echo $row['customer-address']; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11">No archived orders found.</td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11">Failed to fetch archived orders.</td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>

<?php include('parials/footer.php'); ?>