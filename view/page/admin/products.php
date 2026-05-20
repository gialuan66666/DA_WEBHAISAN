<?php $pageTitle = 'Quản lý sản phẩm';
require_once './data/data.php';
require_once './view/layouts/admin/header.php'; ?>
<div class="panel">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h5 class="fw-bold mb-1">Danh sách sản phẩm</h5><small class="text-muted">Quản lý thông tin, giá bán và tồn kho</small>
    </div><a href="products/create" class="btn btn-orange rounded-pill"><i class="fa-solid fa-plus me-1"></i>Thêm sản phẩm</a>
  </div>
  <div class="row g-3 mb-4">
    <div class="col-md-5"><input class="form-control" placeholder="Tìm sản phẩm..."></div>
    <div class="col-md-3"><select class="form-select">
        <option>Tất cả danh mục</option>
        <option>Hải sản tươi sống</option>
        <option>Hải sản đông lạnh</option>
      </select></div>
    <div class="col-md-3"><select class="form-select">
        <option>Tất cả trạng thái</option>
        <option>Còn hàng</option>
        <option>Hết hàng</option>
      </select></div>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Danh mục</th>
          <th>Giá</th>
          <th>Kho</th>
          <th>Trạng thái</th>
          <th class="text-end">Thao tác</th>
        </tr>
      </thead>
      <tbody><?php foreach (($adminProducts ?? []) as $p): ?>
            <td><img src="<?= $p['image'] ?? '' ?>" class="product-thumb"></td>
            <td class="fw-bold"><?= $p['name'] ?? '' ?></td>
            <td><?= $p['category_name'] ?? ($p['category'] ?? '') ?></td>
            <td class="text-danger fw-bold"><?= number_format($p['price'] ?? 0) ?>đ</td>
            <td><?= $p['quantity'] ?? ($p['stock'] ?? 0) ?></td>
            <td><span class="badge-soft"><?= $p['status'] ?? '' ?></span></td>
            <td class="text-end"><a href="/admin/products/edit?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">Sửa</a> <button class="btn btn-sm btn-outline-danger rounded-pill">Xóa</button></td>
          </tr><?php endforeach; ?></tbody>
    </table>
  </div>

</div>
<?php require_once './view/layouts/admin/footer.php'; ?>