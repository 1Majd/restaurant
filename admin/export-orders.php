<?php
include('../conf/connect.php');

$output = '';


$sql = "SELECT * FROM `tbl-order` ORDER BY id DESC";
$res = mysqli_query($conn, $sql);


if (mysqli_num_rows($res) > 0) {

    $output .= '
        <table border="1">
            <thead>
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
            </thead>
            <tbody>
    ';

    $sn = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $output .= '
            <tr>
                <td>' . $sn++ . '</td>
                <td>' . $row['food'] . '</td>
                <td>' . $row['price'] . '</td>
                <td>' . $row['qty'] . '</td>
                <td>' . number_format($row['total'], 2) . '</td>
                <td>' . $row['order-date'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['customer-name'] . '</td>
                <td>' . $row['customer-contact'] . '</td>
                <td>' . $row['customer-email'] . '</td>
                <td>' . $row['customer-address'] . '</td>
            </tr>
        ';
    }

    $output .= '</tbody></table>';

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=orders.xls");

    echo $output;
} else {
    echo 'No data found.';
}
