<?php

include('parials/menu.php');

function fetchCounts($conn)
{
    $category_query = "SELECT COUNT(*) AS count FROM `category`";
    $food_query = "SELECT COUNT(*) AS count FROM `food`";
    $order_query = "SELECT COUNT(*) AS count FROM `tbl-order`";

    $today = date('Y-m-d');
    $sales_query = "SELECT SUM(total) AS total FROM `tbl-order` WHERE DATE(`order-date`) = '$today'";

    $pending_query = "SELECT COUNT(*) AS count FROM `tbl-order` WHERE status = 'Pending'";
    $shipped_query = "SELECT COUNT(*) AS count FROM `tbl-order` WHERE status = 'Shipped'";
    $delivered_query = "SELECT COUNT(*) AS count FROM `tbl-order` WHERE status = 'Delivered'";
    $canceled_query = "SELECT COUNT(*) AS count FROM `tbl-order` WHERE status = 'Canceled'";

    $low_quantity_query = "SELECT title, quantity FROM `food` WHERE quantity <= 5";

    $category_result = mysqli_query($conn, $category_query);
    $food_result = mysqli_query($conn, $food_query);
    $order_result = mysqli_query($conn, $order_query);
    $sales_result = mysqli_query($conn, $sales_query);
    $pending_result = mysqli_query($conn, $pending_query);
    $shipped_result = mysqli_query($conn, $shipped_query);
    $delivered_result = mysqli_query($conn, $delivered_query);
    $canceled_result = mysqli_query($conn, $canceled_query);
    $low_quantity_result = mysqli_query($conn, $low_quantity_query);

    $category_count = mysqli_fetch_assoc($category_result)['count'];
    $food_count = mysqli_fetch_assoc($food_result)['count'];
    $order_count = mysqli_fetch_assoc($order_result)['count'];
    $sales_total = mysqli_fetch_assoc($sales_result)['total'];
    $pending_count = mysqli_fetch_assoc($pending_result)['count'];
    $shipped_count = mysqli_fetch_assoc($shipped_result)['count'];
    $delivered_count = mysqli_fetch_assoc($delivered_result)['count'];
    $canceled_count = mysqli_fetch_assoc($canceled_result)['count'];

    $low_quantity_foods = [];
    while ($row = mysqli_fetch_assoc($low_quantity_result)) {
        $low_quantity_foods[] = $row;
    }

    return array(
        'categories' => $category_count,
        'foods' => $food_count,
        'orders' => $order_count,
        'sales' => number_format($sales_total, 2),
        'pending_orders' => $pending_count,
        'shipped_orders' => $shipped_count,
        'delivered_orders' => $delivered_count,
        'canceled_orders' => $canceled_count,
        'low_quantity_foods' => $low_quantity_foods
    );
}

$counts = fetchCounts($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .main-content {
            margin: 2rem auto;
            padding: 2rem;
            max-width: 1200px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-4 {
            flex: 1;
            min-width: 200px;
            padding: 1rem;
            background: #f4f4f4;
            text-align: center;
            border-radius: 5px;
            margin: 0.5rem;
        }

        .low-quantity-foods {
            margin-top: 2rem;
        }

        .low-quantity-foods table {
            width: 100%;
            border-collapse: collapse;
        }

        .low-quantity-foods table th,
        .low-quantity-foods table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .low-quantity-foods table th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php
            if (isset($_COOKIE['user_name'])) {
                echo '<p>Welcome, ' . htmlspecialchars($_COOKIE['user_name']) . '!</p>';
            }
            ?>
            <br><br>
            <div class="stats">
                <div class="col-4">
                    <h1><?php echo $counts['categories']; ?></h1>
                    <br>
                    Categories
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['foods']; ?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['orders']; ?></h1>
                    <br>
                    Orders
                </div>
                <div class="col-4">
                    <h1>$<?php echo $counts['sales']; ?></h1>
                    <br>
                    Daily Sales
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['pending_orders']; ?></h1>
                    <br>
                    Pending Orders
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['shipped_orders']; ?></h1>
                    <br>
                    Shipped Orders
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['delivered_orders']; ?></h1>
                    <br>
                    Delivered Orders
                </div>
                <div class="col-4">
                    <h1><?php echo $counts['canceled_orders']; ?></h1>
                    <br>
                    Canceled Orders
                </div>
            </div>
            <div class="clear-fix"></div>

            <div class="low-quantity-foods">
                <h2>Low Quantity Foods</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Food Title</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($counts['low_quantity_foods'] as $food) : ?>
                            <tr>
                                <td><?php echo $food['title']; ?></td>
                                <td><?php echo $food['quantity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('parials/footer.php'); ?>
</body>

</html>