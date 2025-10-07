<?php include('../conf/connect.php'); ?>
<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div >Pleas login to access Admin planel.</div>";
    header("location: " . SITEURL . 'admin/login.php');
}
?>
<html>

<head>
    <title>food order websit - home page</title>


    <style>
        .menu {
            text-align: center;
            border-bottom: 1px solid gray;
        }

        .menu ul {
            list-style-type: none;
        }

        .menu ul li {
            display: inline;
            padding: 1%;
        }

        .menu ul li a {
            text-decoration: none;
            font-weight: bold;
            color: #053759;

        }

        .menu a:hover {
            color: #453e3f;
        }


        .main-conctent {

            background-color: #f1f2f0;
            padding: 3% 0;
        }

        .col-4 {
            width: 18%;
            background-color: white;
            margin: 1%;
            padding: 2%;
            text-align: center;
            float: left;
        }

        table {
            width: 30%;
        }

        table tr th {
            border-bottom: 1px solid black;
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
        }

        .btn-secondery :hover {
            background-color: #747d8c;
            color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="manage-admin.php">Admin</a>
                </li>
                <li>
                    <a href="manage-categories.php">Categories</a>
                </li>
                <li>
                    <a href="manage-foods.php">Foods</a>
                </li>
                <li>
                    <a href="manage-order.php">order</a>
                </li>
                <li>
                    <a href="logou.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>