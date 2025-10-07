<?php
include('../conf/connect.php');

if (isset($_GET['download']) && $_GET['download'] == 'image') {
    $imagePath = 'path/to/generated/orders.png';
    if (file_exists($imagePath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . basename($imagePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($imagePath));
        readfile($imagePath);
        exit;
    } else {
        echo "Image not found.";
    }
} else {
    echo "Invalid request.";
}
