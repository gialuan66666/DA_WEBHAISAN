<?php
include "data.php";
include "funtion/cart.php";
include "funtion/order.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;

foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<div class="container cc-cart-wrapper">
    <h3 class="cc-cart-title text-center mb-4">Thanh toán đơn hàng</h3>

    <div class="row">

        <!-- FORM -->
        <div class="col-md-7">

            <form method="POST">

                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>

                <button type="submit" name="checkout" class="cc-cart-checkout w-100">
                    Thanh toán ngay
                </button>

            </form>

        </div>

        <!-- SUMMARY -->
        <div class="col-md-5">

            <div class="cc-cart-summary">
                <h5>Đơn hàng</h5>

                <?php foreach ($cart as $item): ?>
                    <div class="d-flex justify-content-between small mb-2">
                        <span><?= $item['name'] ?> x <?= $item['quantity'] ?></span>
                        <span><?= number_format($item['price'] * $item['quantity']) ?>đ</span>
                    </div>
                <?php endforeach; ?>

                <hr>

                <div class="d-flex justify-content-between fw-bold">
                    <span>Tổng</span>
                    <span class="cc-cart-final">
                        <?= number_format($total) ?>đ
                    </span>
                </div>

            </div>

        </div>

    </div>
</div>