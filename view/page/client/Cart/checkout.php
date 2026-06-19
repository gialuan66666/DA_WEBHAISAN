<?php
$pageTitle = 'Thanh toán - SeaFresh';
require_once './data/data.php';
require_once './view/layouts/client/header.php';

$checkoutItems = $checkoutItems ?? [];
$subtotal = 0;
$successOrderId = $_SESSION['order_success_id'] ?? null;
unset($_SESSION['order_success_id']);
?>

<section class="page-banner"><div class="container"><h1>Thanh toán</h1><p>Điền thông tin nhận hàng để hoàn tất đơn hàng.</p></div></section>

<section class="container py-5">
    <?php if ($successOrderId): ?>
        <div class="form-box text-center py-5">
            <h4 class="fw-bold text-blue">Đặt hàng thành công</h4>
            <p class="text-muted mb-4">Mã đơn hàng của bạn là #<?= htmlspecialchars($successOrderId) ?>. SeaFresh sẽ liên hệ xác nhận sớm.</p>
            <a href="/product" class="btn btn-blue rounded-pill px-4">Tiếp tục mua hàng</a>
        </div>
    <?php elseif (empty($checkoutItems)): ?>
        <div class="form-box text-center py-5">
            <h4 class="fw-bold text-blue">Chưa có sản phẩm để thanh toán</h4>
            <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng trước.</p>
            <a href="/product" class="btn btn-blue rounded-pill px-4">Tiếp tục mua hàng</a>
        </div>
    <?php else: ?>
        <form action="/checkout/order" method="POST" class="row g-4">
            <div class="col-lg-8">
                <div class="form-box">
                    <h4 class="fw-bold text-blue mb-4">Thông tin khách hàng</h4>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Họ tên</label><input type="text" name="customer_name" class="form-control" placeholder="Nhập họ tên" required></div>
                        <div class="col-md-6"><label class="form-label">Số điện thoại</label><input type="text" name="customer_phone" class="form-control" placeholder="Nhập số điện thoại" required></div>
                        <div class="col-12"><label class="form-label">Email</label><input type="email" name="customer_email" class="form-control" placeholder="Nhập email"></div>
                        <div class="col-12"><label class="form-label">Địa chỉ giao hàng</label><input type="text" name="customer_address" class="form-control" placeholder="Số nhà, đường, phường/xã, quận/huyện" required></div>
                        <div class="col-12"><label class="form-label">Ghi chú</label><textarea name="note" class="form-control" rows="4" placeholder="Ví dụ: giao sau 18h, sơ chế sạch..."></textarea></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="summary-box">
                    <h4 class="fw-bold mb-4">Đơn hàng của bạn</h4>
                    <?php foreach ($checkoutItems as $item): ?>
                        <?php
                            $quantity = max(1, (int)($item['quantity'] ?? 1));
                            $lineTotal = (float)$item['price'] * $quantity;
                            $subtotal += $lineTotal;
                        ?>
                        <div class="d-flex gap-3 mb-3">
                            <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">
                            <div class="flex-grow-1">
                                <div class="fw-semibold"><?= $item['name'] ?></div>
                                <div class="small text-muted">SL: <?= $quantity ?> x <?= priceFormat($item['price']) ?></div>
                            </div>
                            <strong><?= priceFormat($lineTotal) ?></strong>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between"><span>Tạm tính</span><strong><?= priceFormat($subtotal) ?></strong></div>
                    <div class="d-flex justify-content-between mt-3"><span>Phí giao hàng</span><strong><?= priceFormat(30000) ?></strong></div>
                    <div class="d-flex justify-content-between fs-5 mt-3"><span>Tổng cộng</span><strong class="text-coral"><?= priceFormat($subtotal + 30000) ?></strong></div>
                    <hr>
                    <h4 class="fw-bold mb-4">Phương thức thanh toán</h4>
                    <input type="hidden" name="payment_method" value="cod">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" checked disabled>
                        <label class="form-check-label">Thanh toán khi nhận hàng</label>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 rounded-pill py-3">Đặt hàng</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
