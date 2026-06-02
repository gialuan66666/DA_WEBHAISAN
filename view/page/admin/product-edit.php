<?php
$pageTitle = 'Sửa sản phẩm';

require_once './controllers/admin/ProductController.php';

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productController->update();
}

$id = (int)($_GET['id'] ?? 0);
$product = $productController->getProductById($id);
$categories = $productController->getCategories();

if (!$product) {
    $_SESSION['toast'] = [
        'type' => 'error',
        'message' => 'Không tìm thấy sản phẩm'
    ];

    header('Location: /admin/products');
    exit;
}

require_once './view/layouts/admin/header.php';
require_once './component/notifi.php';
?>

<div class="panel">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <div class="row g-4">
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Thông tin sản phẩm</h5>
                <div class="mb-3"><label class="form-label">Tên sản phẩm</label><input name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" class="form-control" placeholder="VD: Tôm hùm bông"></div>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Danh mục</label><select name="category_id" class="form-select">
                            <?php foreach (($categories ?? []) as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= ($product['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select></div>
                    <div class="col-md-6"><label class="form-label">Đơn vị</label><input name="unit" value="<?= htmlspecialchars($product['unit'] ?? 'kg') ?>" class="form-control" placeholder="kg / con"></div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6"><label class="form-label">Giá cũ</label><input name="old_price" value="<?= htmlspecialchars($product['old_price'] ?? 0) ?>" class="form-control" type="number"></div>
                    <div class="col-md-6"><label class="form-label">Giá bán</label><input name="price" value="<?= htmlspecialchars($product['price'] ?? 0) ?>" class="form-control" type="number"></div>
                </div>
                <div class="mb-3 mt-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea></div>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Ảnh & trạng thái</h5>
                <div class="mb-3"><label class="form-label">Ảnh sản phẩm</label>
                    <?php if (!empty($product['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= htmlspecialchars($product['image']) ?>" class="product-thumb">
                        </div>
                    <?php endif; ?>
                    <input name="image" class="form-control" type="file" accept="image/*">
                </div><div class="mb-3"><label class="form-label">Tồn kho</label><input name="quantity" value="<?= htmlspecialchars($product['quantity'] ?? 0) ?>" class="form-control" type="number"></div>
                <div class="mb-4"><label class="form-label">Trạng thái</label><select name="status" class="form-select">
                        <option value="available" <?= ($product['status'] ?? '') === 'available' ? 'selected' : '' ?>>Còn hàng</option>
                        <option value="out_of_stock" <?= ($product['status'] ?? '') === 'out_of_stock' ? 'selected' : '' ?>>Hết hàng</option>
                        <option value="hidden" <?= ($product['status'] ?? '') === 'hidden' ? 'selected' : '' ?>>Ẩn sản phẩm</option>
                    </select></div><button type="submit" class="btn btn-blue w-100 rounded-pill">Lưu sản phẩm</button>
            </div>
        </div>
    </form>
</div>
<?php require_once './view/layouts/admin/footer.php'; ?>