<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ================= ADD TO CART ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {

    $id = $_POST['product_id'];
    $qty = (int)($_POST['quantity'] ?? 1);

    
    include "data.php";

    $product = null;
    foreach ($Products as $item) {
        if ($item['id'] == $id) {
            $product = $item;
            break;
        }
    }

    if ($product) {

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'category' => $product['category'],
                'options' => [
                    'size' => 'M'
                ],
                'quantity' => $qty
            ];
        }
    }

    header("Location: /cart");
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['checkout'])) {

    $id = $_POST['product_id'] ?? null;

    if ($id && isset($_SESSION['cart'][$id])) {

        if (isset($_POST['increase'])) {
            $_SESSION['cart'][$id]['quantity']++;
        }

        if (isset($_POST['decrease'])) {
            $_SESSION['cart'][$id]['quantity']--;

            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }

        if (isset($_POST['remove'])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: /cart");
    exit;
}