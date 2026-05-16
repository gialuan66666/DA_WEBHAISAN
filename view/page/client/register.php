<?php
$pageTitle = 'Đăng ký - SeaFresh';
require_once './view/layouts/client/header.php';
?>

<section class="auth-section">
    <div class="auth-card">
        <h2 class="text-center fw-bold text-blue mb-2">Đăng ký</h2>
        <p class="text-center text-muted mb-4">Tạo tài khoản mua hải sản nhanh hơn</p>
        <form>
            <div class="mb-3"><label class="form-label">Họ tên</label><input type="text" class="form-control" placeholder="Nhập họ tên"></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="Nhập email"></div>
            <div class="mb-3"><label class="form-label">Số điện thoại</label><input type="text" class="form-control" placeholder="Nhập số điện thoại"></div>
            <div class="mb-3"><label class="form-label">Mật khẩu</label><input type="password" class="form-control" placeholder="Nhập mật khẩu"></div>
            <button type="button" class="btn btn-orange w-100 rounded-pill py-2">Đăng ký</button>
        </form>
        <p class="text-center mt-4 mb-0">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
