<?php
include('../conf/connect.php');
session_start();

session_destroy();
header("Location: " . SITEURL . 'admin/login.php');
exit;
