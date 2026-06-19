<?php
$pageTitle = 'Giỏ hàng - SeaFresh';

require_once './data/data.php';
require_once './view/layouts/client/header.php';

$cartItems = $cartItems ?? [];
$total = 0;
?>

<section class="page-banner"><div class="container"><h1>Giỏ hàng</h1><p>Kiểm tra sản phẩm trước khi thanh toán.</p></div></section>

<section class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-box">
                <?php if (empty($cartItems)): ?>
                    <div class="text-center py-5">
                        <h5 class="fw-bold text-blue">Giỏ hàng của bạn đang trống</h5>
                        <p class="text-muted mb-4">Hãy thêm sản phẩm để bắt đầu thanh toán.</p>
                        <a href="/product" class="btn btn-blue rounded-pill px-4">Tiếp tục mua hàng</a>
                    </div>
                <?php endif; ?>

                <?php foreach ($cartItems as $item): ?>
                    <?php
                        $quantity = max(1, (int)($item['quantity'] ?? 1));
                        $lineTotal = (float)$item['price'] * $quantity;
                        $total += $lineTotal;
                    ?>
                    <div class="cart-item">
                        <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="flex-grow-1">
                            <h5><?= $item['name'] ?></h5>
                            <p class="text-muted mb-1">Đơn vị: <?= $item['unit'] ?></p>
                            <strong class="text-coral"><?= priceFormat($item['price']) ?></strong>
                            <p class="mb-0 small text-muted">Thành tiền: <?= priceFormat($lineTotal) ?></p>
                        </div>
                        <form action="/cart/update" method="POST" class="quantity-box small-qty">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <input type="hidden" name="quantity" value="<?= $quantity ?>">
                            <button type="submit" name="action" value="decrease" class="qty-btn minus">-</button>
                            <input type="text" value="<?= $quantity ?>" class="qty-input" readonly>
                            <button type="submit" name="action" value="increase" class="qty-btn plus">+</button>
                        </form>
                        <form action="/cart/remove" method="POST">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <button type="submit" class="btn btn-outline-danger rounded-circle">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="summary-box">
                <h4 class="fw-bold mb-4">Tóm tắt đơn hàng</h4>
                <div class="d-flex justify-content-between"><span>Tạm tính</span><strong><?= priceFormat($total) ?></strong></div>
                <div class="d-flex justify-content-between mt-3"><span>Phí giao hàng</span><strong><?= priceFormat($total > 0 ? 30000 : 0) ?></strong></div>
                <hr>
                <div class="d-flex justify-content-between fs-5"><span>Tổng cộng</span><strong class="text-coral"><?= priceFormat($total > 0 ? $total + 30000 : 0) ?></strong></div>
                <?php if ($total > 0): ?>
                    <a href="/checkout?source=cart" class="btn btn-orange w-100 rounded-pill mt-4 py-3">Thanh toán</a>
                <?php else: ?>
                    <button type="button" class="btn btn-orange w-100 rounded-pill mt-4 py-3" disabled>Thanh toán</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
