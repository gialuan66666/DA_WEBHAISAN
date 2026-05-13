<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    if (empty($_SESSION['cart'])) {
        header("Location: /cart");
        exit;
    }

    $cart = $_SESSION['cart'];

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = [
        'id' => time(),
        'fullname' => $_POST['fullname'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'note' => $_POST['note'],
        'items' => $cart,
        'total' => $total,
        'created_at' => date('Y-m-d H:i:s')
    ];

    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    $_SESSION['orders'][] = $order;


    $_SESSION['cart'] = [];


    header("Location: /order-success");
    exit;
}