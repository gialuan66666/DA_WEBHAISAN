<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_comment'])) {

    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $content = trim($_POST['content']);
    $username = $_SESSION['user']['username'] ?? 'Khách';

    if ($content != '') {
        $_SESSION['comments'][] = [
            "product_id" => $product_id,
            "username" => $username,
            "rating" => $rating,
            "content" => $content,
            "time" => date("d/m/Y H:i")
        ];
    }

   header("Location: /productdetail?id=" . $product_id);
exit;
}
