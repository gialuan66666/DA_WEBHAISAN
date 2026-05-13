<?php
$FinalCart = [
    'items' => [],
    'total_amount' => 0
];

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {

        $item['subtotal'] = $item['price'] * $item['quantity'];

        $FinalCart['items'][] = $item;
        $FinalCart['total_amount'] += $item['subtotal'];
    }
}
?>