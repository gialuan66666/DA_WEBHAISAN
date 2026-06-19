<div class="product-card">
    <div class="product-img-wrap">
        <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <span class="fresh-label">Tươi sống 100%</span>
    </div>
    <div class="product-body">
        <p class="product-category"><?= $product['category'] ?></p>
        <h5><?= $product['name'] ?></h5>
        <p class="unit">Đơn vị: <?= $product['unit'] ?></p>
        <?php if (!empty($product['old_price']) && $product['old_price'] > 0): ?>
            <p class="old-price"><?= priceFormat($product['old_price']) ?></p>
        <?php endif; ?>

        <p class="new-price"><?= priceFormat($product['price']) ?></p>
        <div class="d-flex gap-2">
            <a href="/productdetail?id=<?= $product['id'] ?>" class="btn btn-outline-primary w-50 rounded-pill">Chi tiết</a>
            <form action="/cart/add" method="POST" class="w-50">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-blue w-100 rounded-pill">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
</div>
