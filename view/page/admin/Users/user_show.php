<?php
$pageTitle = 'Chi tiết khách hàng';
require_once './view/layouts/admin/header.php';
?>

<div class="panel">
    <h5 class="fw-bold mb-3">Chi tiết khách hàng</h5>

    <?php if (!empty($user)): ?>
        <div class="mb-2">
            <strong>Tên:</strong> <?= htmlspecialchars($user['fullname']) ?>
        </div>

        <div class="mb-2">
            <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
        </div>

        <div class="mb-2">
            <strong>SĐT:</strong> <?= htmlspecialchars($user['phone']) ?>
        </div>

        <div class="mb-2">
            <strong>Trạng thái:</strong>
            <?= $user['status'] ? 'Hoạt động' : 'Khóa' ?>
        </div>

        <div class="mb-2">
            <strong>Ngày tạo:</strong> <?= $user['created_at'] ?>
        </div>

        <a href="/admin/users" class="btn btn-secondary mt-3">
            ← Quay lại
        </a>

    <?php else: ?>
        <p class="text-danger">Không tìm thấy khách hàng</p>
    <?php endif; ?>
</div>

<?php require_once './view/layouts/admin/footer.php'; ?>