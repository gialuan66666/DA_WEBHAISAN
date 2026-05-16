<?php
$pageTitle = 'Sản phẩm - SeaFresh';
require_once './data/data.php';
require_once './view/layouts/client/header.php';
$keyword = $_GET['q'] ?? '';
$displayProducts = $products;
if ($keyword !== '') {
    $displayProducts = array_filter($products, function($p) use ($keyword) {
        return stripos($p['name'], $keyword) !== false || stripos($p['category'], $keyword) !== false;
    });
}
?>

<section class="page-banner">
    <div class="container">
        <h1>Sản phẩm hải sản</h1>
        <p>Hải sản tươi sống, đông lạnh, sơ chế sẵn và giao nhanh trong ngày.</p>
    </div>
</section>

<section class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="filter-box">
                <h5 class="fw-bold mb-3">Bộ lọc</h5>
                <form action="products.php" method="get">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" class="form-control mb-3" placeholder="Tên sản phẩm...">
                    <label class="form-label">Danh mục</label>
                    <select class="form-select mb-3">
                        <option>Tất cả</option>
                        <option>Hải sản tươi sống</option>
                        <option>Hải sản đông lạnh</option>
                        <option>Đồ khô</option>
                    </select>
                    <button class="btn btn-blue w-100">Lọc sản phẩm</button>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-blue mb-1">Danh sách sản phẩm</h2>
                    <p class="text-muted mb-0">Tìm thấy <?= count($displayProducts) ?> sản phẩm</p>
                </div>
                <select class="form-select sort-select">
                    <option>Sắp xếp mặc định</option>
                    <option>Giá tăng dần</option>
                    <option>Giá giảm dần</option>
                    <option>Mới nhất</option>
                </select>
            </div>
            <div class="row g-4">
                <?php foreach($displayProducts as $product): ?>
                    <div class="col-sm-6 col-xl-4">
                        <?php include './view/layouts/client/product-card.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
