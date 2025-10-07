<?php
if (isset($_POST['image'])) {
    $data = $_POST['image'];
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);

    $filePath = 'path/to/save/orders.png';
    file_put_contents($filePath, $data);
    echo 'Image saved successfully.';
} else {
    echo 'No image data received.';
}
