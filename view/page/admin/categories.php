<?php $pageTitle = 'Quản lý danh mục';
require_once './view/layouts/admin/header.php'; ?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="panel">
            <h5 class="fw-bold mb-3">Thêm danh mục</h5><input class="form-control mb-3" placeholder="Tên danh mục"><textarea class="form-control mb-3" rows="4" placeholder="Mô tả"></textarea><button class="btn btn-blue w-100 rounded-pill">Lưu danh mục</button>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel">
            <h5 class="fw-bold mb-3">Danh sách danh mục</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Sản phẩm</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody><?php foreach (['Hải sản tươi sống', 'Hải sản đông lạnh', 'Đồ khô', 'Gia vị & sơ chế'] as $i => $c): ?><tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-bold"><?= $c ?></td>
                            <td><?= rand(8, 32) ?></td>
                            <td><span class="badge-soft">Hiển thị</span></td>
                            <td class="text-end"><button class="btn btn-sm btn-outline-primary rounded-pill">Sửa</button></td>
                        </tr><?php endforeach; ?></tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>