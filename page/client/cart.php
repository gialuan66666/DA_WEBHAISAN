<?php
include "data.php";
include "funtion/cart.php";

?>

<div class="cc-cart-wrapper container">
    <h3 class="cc-cart-title text-center mb-4">Giỏ hàng của bạn</h3>

    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($FinalCart['items'])): ?>
                <?php foreach ($FinalCart['items'] as $item): ?>
                    <div class="cc-cart-item d-flex align-items-center mb-3">

                        <img src="<?= $item['image'] ?>" class="cc-cart-img" alt="<?= $item['name'] ?>">

                        <div class="cc-cart-info flex-grow-1">
                            <h5><?= $item['name'] ?></h5>
                            <p class="text-muted small mb-1">
                                Danh mục: <?= $item['category'] ?? 'Trà sữa' ?> <br>
                                Size: <?= $item['options']['size'] ?? 'M' ?>
                            </p>
                            <p class="cc-cart-price"><?= number_format($item['price'], 0, ',', '.') ?>đ</p>

                            <div class="cc-cart-qty">
                                <form method="POST" style="display:flex; gap:5px;">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">

                                    <button type="submit" name="decrease">-</button>

                                    <input type="text" value="<?= $item['quantity'] ?>" readonly style="width:40px; text-align:center;">

                                    <button type="submit" name="increase">+</button>
                                </form>
                            </div>
                        </div>

                        <div class="cc-cart-total">
                            <?= number_format($item['subtotal'], 0, ',', '.') ?>đ
                        </div>

                        <form method="POST" onsubmit="return confirm('Bạn có muốn xoá sản phẩm này không?')">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <button type="submit" name="remove" class="cc-cart-remove">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="cc-cart-summary">
                <h5>Tổng đơn hàng</h5>

                <div class="d-flex justify-content-between">
                    <span>Tạm tính</span>
                    <span><?= number_format($FinalCart['total_amount'], 0, ',', '.') ?>đ</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold">
                    <span>Tổng cộng</span>
                    <span class="cc-cart-final">
                        <?= number_format($FinalCart['total_amount'], 0, ',', '.') ?>đ
                    </span>
                </div>

                <form action="/order" method="GET">
                    <button type="submit" class="cc-cart-checkout w-100 mt-3">
                        Thanh toán
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>