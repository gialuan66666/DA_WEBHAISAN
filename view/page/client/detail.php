<?php
$pageTitle = 'Chi tiết sản phẩm - SeaFresh';
require_once './data/data.php';
$id = $_GET['id'] ?? 1;
$product = getProductById($products, $id);
require_once './view/layouts/client/header.php';
?>

<section class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <img src="<?= $product['image'] ?>" class="img-fluid rounded-5 shadow product-detail-img" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
        <div class="col-lg-6">
            <span class="badge bg-success mb-3">Tươi sống 100%</span>
            <h1 class="fw-bold text-blue"><?= $product['name'] ?></h1>
            <p class="text-muted">Danh mục: <?= $product['category'] ?> | Đơn vị: <?= $product['unit'] ?></p>
            <p class="old-price fs-5"><?= priceFormat($product['old_price']) ?></p>
            <p class="new-price display-6"><?= priceFormat($product['price']) ?></p>
            <p class="lead"><?= $product['desc'] ?></p>
            <div class="quantity-box mb-4">
                <button type="button" class="qty-btn minus">-</button>
                <input type="text" value="1" class="qty-input">
                <button type="button" class="qty-btn plus">+</button>
            </div>
            <div class="d-flex gap-3 flex-wrap">

                <form action="/cart/add" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="quantity" id="cartQty" value="1">

                    <button type="submit" class="btn btn-orange btn-lg rounded-pill px-4">
                        <i class="fa-solid fa-cart-plus"></i>
                        Thêm vào giỏ
                    </button>
                </form>

                <form action="/buy-now" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="quantity" id="buyQty" value="1">

                    <button type="submit" class="btn btn-blue btn-lg rounded-pill px-4">
                        Mua ngay
                    </button>
                </form>

            </div>

            <script>
                const qtyInput = document.querySelector('.qty-input');
                const minusBtn = document.querySelector('.minus');
                const plusBtn = document.querySelector('.plus');
                const cartQty = document.getElementById('cartQty');
                const buyQty = document.getElementById('buyQty');

                function syncQty() {
                    cartQty.value = qtyInput.value;
                    buyQty.value = qtyInput.value;
                }

                plusBtn.addEventListener('click', function() {
                    qtyInput.value = Number(qtyInput.value) + 1;
                    syncQty();
                });

                minusBtn.addEventListener('click', function() {
                    if (Number(qtyInput.value) > 1) {
                        qtyInput.value = Number(qtyInput.value) - 1;
                    }

                    syncQty();
                });
            </script>
        </div>
    </div>
</section>

<section class="container pb-5">
    <h3 class="fw-bold text-blue mb-4">Sản phẩm liên quan</h3>
    <div class="row g-4">
        <?php foreach (array_slice($products, 0, 4) as $product): ?>
            <div class="col-sm-6 col-lg-3"><?php include './view/layouts/client/product-card.php'; ?></div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>