<?php include('../conf/connect.php'); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        .login {
            width: 90%;
            max-width: 400px;
            border: 1px solid grey;
            margin: 10% auto;
            padding: 2rem;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #053759;
            padding: 1rem;
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            width: 100%;
            text-align: center;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #747d8c;
            color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        @media (max-width: 768px) {
            .login {
                width: 95%;
                margin: 20% auto;
            }
        }


        @media (min-width: 1200px) {
            .login {
                width: 25%;
            }
        }
    </style>
</head>

<body>
    <div class="login ">
        <h1 class="text-center">LogIn</h1> <br><br>
        <?php
        if (isset($_COOKIE['login'])) {
            echo $_COOKIE['login'];
            setcookie('login', '', time() - 3600);
        }
        ?>

        <form action="" method="post" class="text-center">
            <br><br> UserName: <br>
            <input type="text" name="username" placeholder="username">
            <br><br>Password: <br>
            <input type="text" name="password" placeholder="passord">


            <br><br><input type="submit" name="submit" value="login" class="btn-primary">
        </form>

    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM iadmin WHERE `user-name`='$username' AND `password`='$password'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div> login successful </div>";
        $_SESSION['user'] =  $username;


        header("location: " . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div> User name or password does not match  </div>";
        header("location: " . SITEURL . 'admin/login.php');
    }
}
?>