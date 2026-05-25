<?php $pageTitle = 'Thêm sản phẩm';
require_once './controllers/ProductController.php';
$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productController->store();
}
$categories = $productController->getCategories();
require_once './view/layouts/admin/header.php'; ?>
<div class="panel">
    <form method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Thông tin sản phẩm</h5>
                <div class="mb-3"><label class="form-label">Tên sản phẩm</label><input name="name" class="form-control" placeholder="VD: Tôm hùm bông"></div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Danh mục</label><select name="category_id" class="form-select">
                            <?php foreach (($categories ?? []) as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select></div>
                    <div class="col-md-6"><label class="form-label">Đơn vị</label><input name="unit" class="form-control" value="kg" placeholder="kg / con"></div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6"><label class="form-label">Giá cũ</label><input name="old_price" class="form-control" type="number"></div>
                    <div class="col-md-6"><label class="form-label">Giá bán</label><input name="price" class="form-control" type="number"></div>
                </div>
                <div class="mb-3 mt-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control" rows="5"></textarea></div>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Ảnh & trạng thái</h5>
                <div class="mb-3"><label class="form-label">Ảnh sản phẩm</label><input name="image" class="form-control" type="file" accept="image/*"></div>
                <div class="mb-3"><label class="form-label">Tồn kho</label><input name="quantity" class="form-control" type="number"></div>
                <div class="mb-4"><label class="form-label">Trạng thái</label><select name="status" class="form-select">
                        <option value="available">Còn hàng</option>
                        <option value="out_of_stock">Hết hàng</option>
                    </select></div><button type="submit" class="btn btn-blue w-100 rounded-pill">Lưu sản phẩm</button>
            </div>
        </div>
    </form>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>