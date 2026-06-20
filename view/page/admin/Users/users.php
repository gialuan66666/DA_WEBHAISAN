<?php
$pageTitle = 'Quản lý khách hàng';
require_once './view/layouts/admin/header.php';
?>

<div class="panel">
    <h5 class="fw-bold mb-3">Danh sách khách hàng</h5>

    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th class="text-end">Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $c): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($c['fullname'] ?? '') ?></td>
                        <td><?= htmlspecialchars($c['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($c['phone'] ?? '') ?></td>

                        <td>
                            <?php if (($c['status'] ?? 0) == 1): ?>
                                <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Khóa</span>
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($c['created_at'] ?? '') ?></td>

                        <td class="text-end d-flex justify-content-end gap-2">

                            <a href="/user_show?id=<?= $c['id'] ?>"
                                class="btn btn-sm btn-outline-info rounded-pill">
                                Xem
                            </a>

                            <a href="/user_edit?id=<?= $c['id'] ?>"
                                class="btn btn-sm btn-outline-primary rounded-pill">
                                Sửa
                            </a>
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?= $c['id'] ?>"
                                data-name="<?= htmlspecialchars($c['fullname']) ?>"
                                data-action="/user_delete">
                                Xóa
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Không có khách hàng nào
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require_once './component/form-delete.php'; ?>
<?php require_once './view/layouts/admin/footer.php'; ?>