<?php
include "funtion/product.php";
include "funtion/cart.php";
?>

<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-3 sidebar">


<form method="GET">

    <!-- giữ filter -->
    <input type="hidden" name="category" value="<?= $category ?>">
    <input type="hidden" name="price" value="<?= $maxPrice ?>">
    <input type="hidden" name="page" value="1">

    <!-- SEARCH -->
    <div class="sidebar-box">
        <h5 class="sidebar-title">Tìm kiếm</h5>

        <div class="custom-search-group">
            <input type="text"
                   name="keyword"
                   value="<?= $keyword ?>"
                   class="form-control custom-search-input"
                   placeholder="Tìm sản phẩm...">

            <button type="submit" class="btn custom-search-btn">
                Tìm...
            </button>
        </div>
    </div>

    <!-- CATEGORY -->
<div class="sidebar-box">
    <h5 class="sidebar-title">Danh Mục</h5>

    <?php foreach ($Categories as $Category): ?>
        <div style="margin: 10px 0;">
            <button type="submit"
                    name="category"
                    value="<?= $Category['id'] ?>"
                    class="btn btn-link p-0 text-start"
                    style="text-decoration:none; color:black;">
                <?= $Category['name'] ?>
            </button>
        </div>
    <?php endforeach; ?>
</div>

    <!-- PRICE -->
    <div class="sidebar-box">
        <h5 class="sidebar-title">Lọc giá</h5>

        <input type="range"
               name="price"
               min="0"
               max="100000"
               value="<?= $maxPrice ?>"
               class="form-range"
               style="accent-color: rgb(19,103,104);"
               oninput="this.nextElementSibling.innerText =
               '0đ - ' + Number(this.value).toLocaleString('vi-VN') + 'đ'">

        <p class="filter-price">
            0đ - <?= number_format($maxPrice, 0, ',', '.') ?>đ
        </p>

        <button type="submit" class="btn btn-dark w-100 mt-2">
            Áp dụng
        </button>
    </div>

</form>

            </div>

            <!-- PRODUCT -->
            <div class="col-md-9">
                <div class="row">

                    <?php if (empty($FilteredProducts)): ?>
                        <p>Không có sản phẩm</p>    
                    <?php endif; ?>

                    <?php foreach ($FilteredProducts as $Product): ?>

                        <div class="col-md-4 mb-4 text-center product-item">
                            <div class="product-img-wrapper">
                                <a href="/productdetail?id=<?= $Product['id'] ?>">
                                    <img src="<?= $Product['image'] ?>" class="product-img">
                                </a>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?= $Product['id'] ?>">
                                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                        Thêm Vào Giỏ Hàng
                                    </button>
                                </form>
                            </div>

                            <h6 class="mt-3">
                                <a href="/productdetail?id=<?= $Product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= $Product['name'] ?>
                                </a>
                            </h6>

                            <div class="star-rating">★★★★☆</div>

                            <p class="price-text">
                                <?= number_format($Product['price'], 0, ',', '.') ?>đ
                            </p>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

        </div>

<div class="my-pagination">

    <a href="?page=<?= max(1, $page - 1) ?>&keyword=<?= $keyword ?>&category=<?= $category ?>&price=<?= $maxPrice ?>">
        <button class="<?= ($page <= 1) ? 'disabled' : '' ?>">«</button>
    </a>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&keyword=<?= $keyword ?>&category=<?= $category ?>&price=<?= $maxPrice ?>">
            <button class="<?= ($i == $page) ? 'active' : '' ?>">
                <?= $i ?>
            </button>
        </a>
    <?php endfor; ?>

    <a href="?page=<?= min($totalPages, $page + 1) ?>&keyword=<?= $keyword ?>&category=<?= $category ?>&price=<?= $maxPrice ?>">
        <button class="<?= ($page >= $totalPages) ? 'disabled' : '' ?>">»</button>
    </a>

</div>

    </div>
</section>