<?php

require_once 'config/database.php';

$db = new Database();
$conn = $db->connect();

$pageTitle = 'Sản phẩm - SeaFresh';

require_once './view/layouts/client/header.php';

$keyword = trim($_GET['q'] ?? '');
$categoryId = (int)($_GET['category_id'] ?? 0);
$minPrice = $_GET['min_price'] ?? '';
$maxPrice = $_GET['max_price'] ?? '';
$sort = $_GET['sort'] ?? 'newest';

$categoriesStmt = $conn->prepare("SELECT id, name FROM categories ORDER BY name ASC");
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll();

$where = [];
$params = [];

if ($keyword !== '') {
    $where[] = "p.name LIKE :keyword";
    $params[':keyword'] = '%' . $keyword . '%';
}

if ($categoryId > 0) {
    $where[] = "p.category_id = :category_id";
    $params[':category_id'] = $categoryId;
}

if ($minPrice !== '' && is_numeric($minPrice)) {
    $where[] = "p.price >= :min_price";
    $params[':min_price'] = (float)$minPrice;
}

if ($maxPrice !== '' && is_numeric($maxPrice)) {
    $where[] = "p.price <= :max_price";
    $params[':max_price'] = (float)$maxPrice;
}

$orderBy = match ($sort) {
    'price_asc' => 'p.price ASC',
    'price_desc' => 'p.price DESC',
    'name_asc' => 'p.name ASC',
    default => 'p.id DESC',
};

$sql = "
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON c.id = p.category_id
";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY " . $orderBy;

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$displayProducts = $stmt->fetchAll();

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .product-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        transition: 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .text-orange {
        color: #ff6a00;
    }
</style>

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

                <form method="get">
                    <label class="form-label">Tìm kiếm</label>

                    <input
                        type="text"
                        name="q"
                        value="<?= htmlspecialchars($keyword) ?>"
                        class="form-control mb-3"
                        placeholder="Tên sản phẩm...">

                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select mb-3">
                        <option value="0">Tất cả danh mục</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= $categoryId === (int)$category['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label">Khoảng giá</label>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <input
                                type="number"
                                min="0"
                                name="min_price"
                                value="<?= htmlspecialchars($minPrice) ?>"
                                class="form-control"
                                placeholder="Từ">
                        </div>
                        <div class="col-6">
                            <input
                                type="number"
                                min="0"
                                name="max_price"
                                value="<?= htmlspecialchars($maxPrice) ?>"
                                class="form-control"
                                placeholder="Đến">
                        </div>
                    </div>

                    <label class="form-label">Sắp xếp</label>
                    <select name="sort" class="form-select mb-3">
                        <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                        <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Giá thấp đến cao</option>
                        <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Giá cao đến thấp</option>
                        <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Tên A-Z</option>
                    </select>

                    <button class="btn btn-primary w-100">
                        Lọc sản phẩm
                    </button>

                    <a href="/product" class="btn btn-outline-secondary w-100 mt-2">
                        Xóa bộ lọc
                    </a>
                </form>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        Danh sách sản phẩm
                    </h2>

                    <p class="text-muted mb-0">
                        Tìm thấy <?= count($displayProducts) ?> sản phẩm
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <?php foreach ($displayProducts as $product): ?>

                    <div class="col-sm-6 col-xl-4">

                        <div class="product-card shadow-sm">

                            <div class="position-relative">
                                <img
                                    src="<?= $product['image'] ?? 'https://via.placeholder.com/300' ?>"
                                    class="product-img">

                                <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">
                                    Tươi sống 100%
                                </span>
                            </div>

                            <div class="p-3">

                                <p class="text-muted small mb-1">
                                    <?= htmlspecialchars($product['category_name'] ?? 'Hải sản tươi sống') ?>
                                </p>

                                <h5 class="fw-bold mb-2">
                                    <?= $product['name'] ?>
                                </h5>

                                <p class="text-muted small mb-1">
                                    Đơn vị: <?= $product['unit'] ?? 'kg' ?>
                                </p>

                                <p class="text-muted text-decoration-line-through mb-1" style="height:24px;">
                                    <?php if (!empty($product['old_price']) && $product['old_price'] > 0): ?>
                                        <?= number_format($product['old_price']) ?>đ
                                    <?php endif; ?>
                                </p>

                                <h4 class="text-orange fw-bold mb-3">
                                    <?= number_format($product['price']) ?>đ
                                </h4>

                                <form action="/cart/add" method="POST" class="m-0">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="quantity" value="1">

                                    <div class="d-flex gap-2">
                                        <a href="/productdetail?id=<?= $product['id'] ?>" class="btn btn-outline-primary w-50 rounded-pill">
                                            Chi tiết
                                        </a>

                                        <button
                                            type="submit"
                                            class="btn btn-primary w-50 rounded-pill d-flex justify-content-center align-items-center">
                                            <i class="bi bi-cart3"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>

<?php require_once './view/layouts/client/footer.php'; ?>
