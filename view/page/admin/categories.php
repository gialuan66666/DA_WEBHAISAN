<?php $pageTitle = 'Quản lý danh mục';
require_once './view/layouts/admin/header.php'; ?>

<div class="row g-4">

    <!-- FORM THÊM -->
    <div class="col-lg-4">
        <div class="panel">
            <h5 class="fw-bold mb-3">Thêm danh mục</h5>

            <form method="POST" action="/admin/categories" enctype="multipart/form-data">
                <input type="hidden" name="action" value="store">

                <input name="name" class="form-control mb-3" placeholder="Tên danh mục" required>

                <textarea name="description" class="form-control mb-3" rows="4"
                    placeholder="Mô tả"></textarea>

                <select name="status" class="form-control mb-3">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>

                <button class="btn btn-blue w-100 rounded-pill">
                    Lưu danh mục
                </button>
            </form>
        </div>
    </div>

    <!-- DANH SÁCH -->
    <div class="col-lg-8">
        <div class="panel">
            <h5 class="fw-bold mb-3">Danh sách danh mục</h5>

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Sản phẩm</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $i => $c): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>

                                <td class="fw-bold"><?= htmlspecialchars($c['name']) ?></td>

                                <td><?= $c['product_count'] ?? 0 ?></td>

                                <td>
                                    <?php if ($c['status']): ?>
                                        <span class="badge bg-success">Hiển thị</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Ẩn</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-end">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-primary rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit_modal_<?= $c['id'] ?>">
                                        Sửa
                                    </button>

                                    <form method="POST" action="/admin/categories" style="display:inline-block;"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục [<?= htmlspecialchars($c['name']) ?>]?')">

                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $c['id'] ?>">

                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Không có danh mục nào
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- ================= MODAL EDIT (ĐÃ ĐƯA RA NGOÀI TABLE) ================= -->
<?php if (!empty($categories)): ?>
    <?php foreach ($categories as $c): ?>
        <div class="modal fade" id="edit_modal_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="/admin/categories"
                    enctype="multipart/form-data"
                    class="modal-content">

                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <input type="hidden" name="old_image" value="<?= $c['image'] ?>">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Sửa danh mục</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-start">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Tên danh mục</label>
                            <input name="name" class="form-control"
                                value="<?= htmlspecialchars($c['name']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Mô tả</label>
                            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($c['description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" <?= $c['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="0" <?= $c['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>

                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require_once './component/form-delete.php'; ?>
<?php require_once './view/layouts/admin/footer.php'; ?>