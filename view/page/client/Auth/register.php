<?php
require_once './view/layouts/client/header.php';
?>

<section class="auth-section">
    <div class="auth-card">
        <h2 class="text-center fw-bold text-blue mb-2">Đăng ký</h2>
        <p class="text-center text-muted mb-4">Tạo tài khoản mua hải sản nhanh hơn</p>

        <form action="/register" method="POST">
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-orange w-100 rounded-pill py-2">
                Đăng ký
            </button>
        </form>

        <p class="text-center mt-4 mb-0">
            Đã có tài khoản? <a href="/login">Đăng nhập</a>
        </p>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>