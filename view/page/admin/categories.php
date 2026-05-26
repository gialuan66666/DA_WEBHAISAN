<?php $pageTitle = 'Quản lý danh mục';
require_once './view/layouts/admin/header.php'; ?>

<div class="row g-4">

    <div class="col-lg-4">
        <div class="panel">
            <h5 class="fw-bold mb-3">Thêm danh mục</h5>

            <input class="form-control mb-3" placeholder="Tên danh mục">

            <textarea class="form-control mb-3" rows="4" placeholder="Mô tả"></textarea>

            <select class="form-control mb-3">
                <option>Hiển thị</option>
                <option>Ẩn</option>
            </select>

            <button class="btn btn-blue w-100 rounded-pill">
                Lưu danh mục
            </button>
        </div>
    </div>

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
                    <?php
                    $categories = [
                        ['name' => 'Hải sản tươi sống', 'status' => 1],
                        ['name' => 'Hải sản đông lạnh', 'status' => 1],
                        ['name' => 'Đồ khô', 'status' => 0],
                        ['name' => 'Gia vị & sơ chế', 'status' => 1],
                    ];

                    foreach ($categories as $i => $c): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>

                            <td class="fw-bold"><?= $c['name'] ?></td>

                            <td><?= rand(8, 32) ?></td>

                            <td>
                                <?php if ($c['status']): ?>
                                    <span class="badge bg-success">Hiển thị</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Ẩn</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">
                                <button
                                    class="btn btn-sm btn-outline-primary rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Sửa
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Sửa danh mục</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input class="form-control mb-3" value="Hải sản tươi sống">

                <textarea class="form-control mb-3" rows="3">Mô tả danh mục...</textarea>

                <select class="form-control">
                    <option>Hiển thị</option>
                    <option>Ẩn</option>
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button class="btn btn-primary">Cập nhật</button>
            </div>

        </div>
    </div>
</div>

<?php require_once './view/layouts/admin/footer.php'; ?>