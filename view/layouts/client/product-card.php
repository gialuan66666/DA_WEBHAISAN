<?php
// Expect variables:
// - $product: associative array for ONE product
// - optional: $linkToDetail (default true)
//
// Usage example:
//   foreach ($displayProducts as $product) { include 'product-card.php'; }
//
// This file renders ONE product card. Do NOT foreach inside.

if (!isset($product) || !is_array($product)) {
    return;
}

$linkToDetail = $linkToDetail ?? true;

$id = $product['id'] ?? null;
$name = $product['name'] ?? '';
$image = $product['image'] ?? '';

// Normalize possible field names across client/admin
$category = $product['category_name'] ?? ($product['category'] ?? '');
$price = $product['price'] ?? 0;
$quantity = $product['quantity'] ?? ($product['stock'] ?? 0);
$status = $product['status'] ?? '';

$detailUrl = $id ? '/productdetail?id=' . $id : '#';
?>

<div class="product-card">
    <div class="product-img-wrap">
        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>" />
        <?php if (!empty($status)): ?>
            <div class="fresh-label">Tình trạng</div>
        <?php endif; ?>
    </div>

    <div class="product-body">
        <?php if ($category): ?>
            <div class="product-category"><?= htmlspecialchars($category) ?></div>
        <?php endif; ?>

        <h5 class="fw-bold"><?= htmlspecialchars($name) ?></h5>

        <div class="unit">Kho: <b><?= htmlspecialchars($quantity) ?></b></div>

        <div class="product-price text-danger fw-bold">
            <?= number_format((float)$price) ?>đ
        </div>

        <?php if ($status !== ''): ?>
            <div class="product-status mb-2">
                <span class="badge-soft"><?= htmlspecialchars($status) ?></span>
            </div>
        <?php endif; ?>

        <div class="product-actions d-flex gap-2">
            <?php if ($linkToDetail): ?>
                <a class="btn btn-sm btn-outline-primary" href="<?= $detailUrl ?>">Xem</a>
            <?php endif; ?>
        </div>
    </div>
</div>

