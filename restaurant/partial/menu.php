<?php include('conf/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: #053759;
        color: #ffffff;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 1%;
    }

    .img-responsive {
        width: 100%;
    }

    .img-curve {
        border-radius: 15px;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-white {
        color: white;
    }

    .clearfix {
        clear: both;
        float: none;
    }

    a {
        color: #ffffff;
        text-decoration: none;
    }

    a:hover {
        color: #d1d1d1;
    }

    .btn {
        padding: 1%;
        border: none;
        font-size: 1rem;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #053759;
        color: white;
        cursor: pointer;
    }

    .btn-primary:hover {
        color: white;
        background-color: #1b5e7b;
    }

    h2 {
        color: #747d8c;
        font-size: 2rem;
        margin-bottom: 2%;
    }

    h3 {
        font-size: 1.5rem;
    }

    .float-container {
        position: relative;
    }

    .float-text {
        position: absolute;
        bottom: 50px;
        left: 40%;
    }

    fieldset {
        border: 1px solid #ffffff;
        margin: 5%;
        padding: 3%;
        border-radius: 5px;
    }

    .logo {
        width: 10%;
        float: left;
    }

    .logo img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .menu {
        line-height: 60px;
    }

    .menu ul {
        list-style-type: none;
    }

    .menu ul li {
        display: inline;
        padding: 1%;
        font-weight: bold;
        color: #ffffff;
    }

    /* CSS for Food Search */
    .food-search {
        background: linear-gradient(rgba(5, 55, 89, 0.7), rgba(5, 55, 89, 0.7)),
            url("https://i.postimg.cc/wT3TQS3V/header-image2.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 7% 0;
    }

    .food-search input[type="search"] {
        width: 50%;
        padding: 1%;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
    }

    /* CSS for Categories */
    .categories {
        padding: 4% 0;
    }

    .box-3 {
        width: 28%;
        float: left;
        margin: 2%;
        box-sizing: border-box;
        border-radius: 15px;
        overflow: hidden;
        text-align: center;
        height: 250px;
    }

    .box-3 img {
        width: 100%;
        height: 100%;
        border-radius: 15px;
        object-fit: cover;
    }

    /* CSS for Food Menu */
    .food-menu {
        background-color: #053759;
        padding: 4% 0;
        color: #ffffff;
    }

    .food-menu-box {
        width: 43%;
        margin: 1%;
        padding: 2%;
        float: right;
        background-color: #ffffff;
        border-radius: 15px;
        color: #053759;
        box-sizing: border-box;
    }

    .food-menu-img {
        margin-right: 0;
        margin-bottom: 15px;
        width: 20%;

        float: left;
        box-sizing: border-box;
    }

    .food-menu-img img {
        width: 100%;
        height: 200px;
        border-radius: 15px;
        object-fit: cover;

    }

    .food-menu-desc {
        width: 70%;
        float: left;
        margin-left: 8%;
    }

    .food-price {
        font-size: 1.2rem;
        margin: 2% 0;
        color: #053759;
    }

    .food-detail {
        font-size: 1rem;
        color: #747d8c;
    }

    /* Clear floats */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    /* CSS for Social */
    .social ul {
        list-style-type: none;
    }

    .social ul li {
        display: inline;
        padding: 1%;
    }

    /* CSS for Order Section */
    .cart {
        margin: 2rem auto;
        padding: 2rem;
        max-width: 1200px;
        background-color: #ffffff;
        border-radius: 10px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
        color: #053759;
    }

    .cart-table th,
    .cart-table td {
        padding: 1rem;
        border: 1px solid #ddd;
        text-align: center;
    }

    .cart-table th {
        background-color: #053759;
        color: #ffffff;
    }

    .cart-table img {
        width: 100px;
        height: auto;
    }

    .order-form {
        margin-top: 2rem;
    }

    .order-form label {
        display: block;
        margin: 0.5rem 0;
        color: #053759;
    }

    .order-form input,
    .order-form textarea {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .order-form input[type="submit"] {
        background-color: #053759;
        color: #fff;
        border: none;
        padding: 1rem;
        cursor: pointer;
    }

    .order-form input[type="submit"]:hover {
        background-color: #1b5e7b;
    }

    .action-buttons {
        margin-top: 1rem;
        display: flex;
        justify-content: space-between;
    }

    .action-buttons input {
        background-color: #053759;
        color: #fff;
        border: none;
        padding: 1rem;
        cursor: pointer;
        border-radius: 5px;
        font-size: 1rem;
    }

    .action-buttons input:hover {
        background-color: #747d8c;
    }

    .cbuttons {
        display: inline-block;
        background-color: #053759;
        color: #fff;
        padding: 0.5rem 1rem;
        text-decoration: none;
        border-radius: 5px;
        font-size: 0.9rem;
        text-align: center;
        transition: background-color 0.3s, color 0.3s;
    }

    .cbuttons:hover {
        background-color: #747d8c;
        color: #f0f0f0;
    }

    .cbuttons:focus {
        outline: none;
    }

    /* CSS for Mobile Size or Smaller Screen */
    @media only screen and (max-width: 768px) {
        .logo {
            width: 80%;
            float: none;
            margin: 1% auto;
        }

        .menu ul {
            text-align: center;
        }

        .food-search input[type="search"] {
            width: 90%;
            padding: 2%;
            margin-bottom: 3%;
        }

        .btn {
            width: 91%;
            padding: 2%;
        }

        .food-search {
            padding: 10% 0;
        }

        .categories {
            padding: 20% 0;
        }

        h2 {
            margin-bottom: 10%;
        }

        .box-3 {
            width: 100%;
            margin: 4% auto;
            height: auto;
        }

        .box-3 img {
            height: auto;
            object-fit: contain;
        }

        .food-menu {
            padding: 20% 0;
        }

        .food-menu-box {
            width: 90%;
            padding: 5%;
            margin-bottom: 5%;
        }

        .social {
            padding: 5% 0;
        }

        .order {
            width: 100%;
            padding: 1rem;
            box-sizing: border-box;
        }

        .cart-table {
            width: 100%;
            font-size: 0.9rem;
        }

        .cart-table th,
        .cart-table td {
            padding: 0.5rem;
        }

        .order-form input[type="submit"],
        .action-buttons input {
            width: 100%;
            padding: 1rem;
            box-sizing: border-box;
        }

        .order-form label,
        .order-form input,
        .order-form textarea {
            margin: 0.5rem 0;
        }

        .order-form input[type="submit"]:hover,
        .action-buttons input:hover {
            background-color: #1b5e7b;
        }

        .cart-table {
            width: 100%;
            display: block;
            font-size: 0.9rem;
            border-collapse: separate;
            border-spacing: 0;
        }

        .cart-table thead {
            display: none;
        }

        .cart-table tbody,
        .cart-table tr {
            display: block;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }

        .cart-table td {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        .cart-table td.cart-cell {
            display: inline-block;
            width: 45%;
            padding: 0.5rem;
            box-sizing: border-box;
        }

        .cart-table img {
            width: 80px;
            height: auto;
        }
    }
    </style>

</head>

<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/OIPyuf.jpeg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php" title="View Cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Cart
                        </a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>