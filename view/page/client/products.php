<?php

require_once 'config/database.php';

$db = new Database();
$conn = $db->connect();

// lấy sản phẩm từ database
$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();

$products = $stmt->fetchAll();

$pageTitle = 'Sản phẩm - SeaFresh';

require_once './view/layouts/client/header.php';

// tìm kiếm
$keyword = $_GET['q'] ?? '';

// mặc định hiển thị tất cả
$displayProducts = $products;

// lọc theo tên
if ($keyword !== '') {

    $displayProducts = array_filter(
        $products,
        function($p) use ($keyword){

            return stripos($p['name'], $keyword) !== false;

        }
    );

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

                <form method="get">

                    <label class="form-label">
                        Tìm kiếm
                    </label>

                    <input 
                        type="text" 
                        name="q" 
                        value="<?= htmlspecialchars($keyword) ?>" 
                        class="form-control mb-3" 
                        placeholder="Tên sản phẩm..."
                    >

                    <button class="btn btn-blue w-100">
                        Lọc sản phẩm
                    </button>

                </form>

            </div>

        </div>

        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h2 class="fw-bold text-blue mb-1">
                        Danh sách sản phẩm
                    </h2>

                    <p class="text-muted mb-0">
                        Tìm thấy <?= count($displayProducts) ?> sản phẩm
                    </p>

                </div>

            </div>

            <div class="row g-4">

                <?php foreach($displayProducts as $product): ?>

                    <div class="col-sm-6 col-xl-4">

                        <?php
                        // render 1 card (layout expects $product)
                        $linkToDetail = true;
                        include './view/layouts/client/product-card.php';
                        ?>

                    </div>

                <?php endforeach; ?>

            </div>


        </div>

    </div>

</section>

<?php require_once './view/layouts/client/footer.php'; ?>