<?php
$pageTitle = 'Giỏ hàng - SeaFresh';
require_once './data/data.php';
require_once './view/layouts/client/header.php';
$cartItems = array_slice($products, 0, 3);
$total = 0;
?>

<section class="page-banner"><div class="container"><h1>Giỏ hàng</h1><p>Kiểm tra sản phẩm trước khi thanh toán.</p></div></section>

<section class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-box">
                <?php foreach($cartItems as $item): $total += $item['price']; ?>
                    <div class="cart-item">
                        <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="flex-grow-1">
                            <h5><?= $item['name'] ?></h5>
                            <p class="text-muted mb-1">Đơn vị: <?= $item['unit'] ?></p>
                            <strong class="text-coral"><?= priceFormat($item['price']) ?></strong>
                        </div>
                        <div class="quantity-box small-qty">
                            <button type="button" class="qty-btn minus">-</button>
                            <input type="text" value="1" class="qty-input">
                            <button type="button" class="qty-btn plus">+</button>
                        </div>
                        <button class="btn btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="summary-box">
                <h4 class="fw-bold mb-4">Tóm tắt đơn hàng</h4>
                <div class="d-flex justify-content-between"><span>Tạm tính</span><strong><?= priceFormat($total) ?></strong></div>
                <div class="d-flex justify-content-between mt-3"><span>Phí giao hàng</span><strong>30.000đ</strong></div>
                <hr>
                <div class="d-flex justify-content-between fs-5"><span>Tổng cộng</span><strong class="text-coral"><?= priceFormat($total + 30000) ?></strong></div>
                <a href="checkout.php" class="btn btn-orange w-100 rounded-pill mt-4 py-3">Thanh toán</a>
            </div>
        </div>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
