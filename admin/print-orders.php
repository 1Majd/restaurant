<?php
include('../conf/connect.php');

$sql = "SELECT * FROM `tbl-order`";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>
    <h1>Orders</h1>
    <button onclick="downloadAsImage()" class="btn-secondery">Download as Image</button>
    <br><br>
    <table id="ordersTable">
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
        if ($res) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$sn}</td>
                    <td>{$row['food']}</td>
                    <td>$ {$row['price']}</td>
                    <td>{$row['qty']}</td>
                    <td>$ " . number_format($row['total'], 2) . "</td>
                    <td>{$row['order-date']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['customer-name']}</td>
                    <td>{$row['customer-contact']}</td>
                    <td>{$row['customer-email']}</td>
                    <td>{$row['customer-address']}</td>
                </tr>";
                $sn++;
            }
        }
        ?>
    </table>

    <script>
        function downloadAsImage() {
            html2canvas(document.querySelector("#ordersTable")).then(canvas => {
                var link = document.createElement('a');
                link.download = 'orders.png';
                link.href = canvas.toDataURL();
                link.click();
            }).catch(error => {
                console.error('Error capturing table as image:', error);
            });
        }
    </script>
</body>

</html>