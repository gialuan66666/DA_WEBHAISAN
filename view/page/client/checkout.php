<?php
$pageTitle = 'Thanh toán - SeaFresh';
require_once './view/layouts/client/header.php';
?>

<section class="page-banner"><div class="container"><h1>Thanh toán</h1><p>Điền thông tin nhận hàng để hoàn tất đơn hàng.</p></div></section>

<section class="container py-5">
    <form class="row g-4">
        <div class="col-lg-8">
            <div class="form-box">
                <h4 class="fw-bold text-blue mb-4">Thông tin khách hàng</h4>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Họ tên</label><input type="text" class="form-control" placeholder="Nhập họ tên"></div>
                    <div class="col-md-6"><label class="form-label">Số điện thoại</label><input type="text" class="form-control" placeholder="Nhập số điện thoại"></div>
                    <div class="col-12"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="Nhập email"></div>
                    <div class="col-12"><label class="form-label">Địa chỉ giao hàng</label><input type="text" class="form-control" placeholder="Số nhà, đường, phường/xã, quận/huyện"></div>
                    <div class="col-12"><label class="form-label">Ghi chú</label><textarea class="form-control" rows="4" placeholder="Ví dụ: giao sau 18h, sơ chế sạch..."></textarea></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="summary-box">
                <h4 class="fw-bold mb-4">Phương thức thanh toán</h4>
                <div class="form-check mb-2"><input class="form-check-input" type="radio" name="pay" checked><label class="form-check-label">Thanh toán khi nhận hàng</label></div>
                <div class="form-check mb-2"><input class="form-check-input" type="radio" name="pay"><label class="form-check-label">Chuyển khoản ngân hàng</label></div>
                <div class="form-check mb-4"><input class="form-check-input" type="radio" name="pay"><label class="form-check-label">Ví MoMo / VNPay</label></div>
                <button type="button" class="btn btn-orange w-100 rounded-pill py-3">Đặt hàng</button>
            </div>
        </div>
    </form>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
