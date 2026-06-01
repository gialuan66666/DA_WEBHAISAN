<div class="product-card">
    <div class="product-img-wrap">
        <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <span class="fresh-label">Tươi sống 100%</span>
    </div>
    <div class="product-body">
        <p class="product-category"><?= $product['category'] ?></p>
        <h5><?= $product['name'] ?></h5>
        <p class="unit">Đơn vị: <?= $product['unit'] ?></p>
        <p class="old-price"><?= priceFormat($product['old_price']) ?></p>
        <p class="new-price"><?= priceFormat($product['price']) ?></p>
        <div class="d-flex gap-2">
            <a href="/productdetail?id=<?= $product['id'] ?>" class="btn btn-outline-primary w-50 rounded-pill">Chi tiết</a>
            <a href="/cart" class="btn btn-blue w-50 rounded-pill"><i class="fa-solid fa-cart-plus"></i></a>
        </div>
    </div>
</div>