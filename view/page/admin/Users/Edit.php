<?php
$pageTitle = 'Sửa khách hàng';
require_once './view/layouts/admin/header.php';
?>

<div class="panel">
    <h5 class="fw-bold mb-3">Sửa khách hàng</h5>

    <?php if (!empty($user)): ?>
       <form method="POST" action="/user_update">

    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Họ và tên</label>
        <input type="text" name="fullname" class="form-control"
            value="<?= htmlspecialchars($user['fullname']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
            value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">SĐT</label>
        <input type="text" name="phone" class="form-control"
            value="<?= htmlspecialchars($user['phone']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input type="text" name="address" class="form-control"
            value="<?= htmlspecialchars($user['address']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>
                Hoạt động
            </option>
            <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>
                Khóa
            </option>
        </select>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Cập nhật
        </button>

        <a href="/admin/users" class="btn btn-secondary">
            Quay lại
        </a>
    </div>
</form>
    <?php else: ?>
        <p class="text-danger">Không tìm thấy người dùng</p>
    <?php endif; ?>
</div>

<?php require_once './view/layouts/admin/footer.php'; ?>