<?php
$pageTitle = 'Đăng nhập - SeaFresh';
require_once './view/layouts/client/header.php';
?>

<section class="auth-section">
    <div class="auth-card">
        <h2 class="text-center fw-bold text-blue mb-2">Đăng nhập</h2>
        <p class="text-center text-muted mb-4">Đăng nhập để quản lý đơn hàng của bạn</p>
        <form>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="admin@gmail.com"></div>
            <div class="mb-3"><label class="form-label">Mật khẩu</label><input type="password" class="form-control" placeholder="Nhập mật khẩu"></div>
            <button type="button" class="btn btn-blue w-100 rounded-pill py-2">Đăng nhập</button>
        </form>
        <p class="text-center mt-4 mb-0">Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
