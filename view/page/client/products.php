<?php

require_once 'config/database.php';

$db = new Database();
$conn = $db->connect();

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();

$products = $stmt->fetchAll();

$pageTitle = 'Sản phẩm - SeaFresh';

require_once './view/layouts/client/header.php';

$keyword = $_GET['q'] ?? '';

$displayProducts = $products;

if ($keyword !== '') {
    $displayProducts = array_filter(
        $products,
        function ($p) use ($keyword) {
            return stripos($p['name'], $keyword) !== false;
        }
    );
}

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

                    <button class="btn btn-primary w-100">
                        Lọc sản phẩm
                    </button>
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
                                    Hải sản tươi sống
                                </p>

                                <h5 class="fw-bold mb-2">
                                    <?= $product['name'] ?>
                                </h5>

                                <p class="text-muted small mb-1">
                                    Đơn vị: <?= $product['unit'] ?? 'kg' ?>
                                </p>

                                <p class="text-muted text-decoration-line-through mb-1">
                                    <?= number_format($product['price'] * 1.2) ?>đ
                                </p>

                                <h4 class="text-orange fw-bold mb-3">
                                    <?= number_format($product['price']) ?>đ
                                </h4>

                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-primary w-50 rounded-pill">
                                        Chi tiết
                                    </a>

                                    <button class="btn btn-primary w-50 rounded-pill d-flex justify-content-center align-items-center">
                                        <i class="bi bi-cart3"></i>
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>

<?php require_once './view/layouts/client/footer.php'; ?>