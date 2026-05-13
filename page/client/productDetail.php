<?php
include "data.php";
include "funtion/cart.php";

$id = $_GET['id'] ?? null;
$ProductDetail = null;

foreach ($Products as $item) {
    if ($item['id'] == $id) {
        $ProductDetail = $item;
        break;
    }
}
if (!$ProductDetail) {
    echo "<h3 style='text-align:center'>Không tìm thấy sản phẩm</h3>";
    exit;
}
?>
<section class="product-detail-section" style="background:#f9f9f9; padding:3rem 0;">
    <div class="container">
        <div class="row">

            
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img id="product-detail-main-img"
                    src="<?= $ProductDetail['image'] ?>"
                    class="product-detail-img-main mb-2"
                    style="width:100%; max-height:350px; object-fit:contain; border-radius:10px;">

                <div class="product-detail-thumbs justify-content-center mt-2">
                    <img src="<?= $ProductDetail['image'] ?>" class="product-detail-thumb active"
                        onclick="changeDetailImage(this)" style="width:60px; height:60px; object-fit:contain;">
                </div>
            </div>

            
            <div class="col-md-6">
                <h2 class="product-detail-title" style="font-size:24px; color:rgb(19,103,104);">
                    <?= $ProductDetail['name'] ?>
                </h2>

                <div class="product-detail-rating mb-2">
                    <?php for ($i = 0; $i < $ProductDetail['rating']; $i++): ?>
                        <i class="fa-solid fa-star"></i>
                    <?php endfor; ?>
                </div>

                <p class="product-detail-price" style="font-size:20px; color:rgb(19,103,104);">
                    <?= number_format($ProductDetail['price'], 0, ',', '.') ?>đ
                </p>

                <form method="POST" >

                    <input type="hidden" name="product_id" value="<?= $ProductDetail['id'] ?>">

                   
                    <div class="d-flex align-items-center mb-3">
                        <label class="me-2">Số lượng:</label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="form-control product-detail-quantity" style="width:70px;">
                    </div>

                    <button type="submit" name="add_to_cart"
                        class="product-detail-add-btn">
                        Thêm vào giỏ hàng
                    </button>

                </form>

               
                <div class="product-detail-desc mt-3" style="font-size:14px;">
                    <h5>Mô tả sản phẩm:</h5>
                    <p><?= $ProductDetail['description'] ?></p>
                </div>
            </div>

        </div>
    </div>

<?php include "comments.php"; ?>
    
</section>

<script>
    function changeDetailImage(el) {
        document.getElementById('product-detail-main-img').src = el.src;
        document.querySelectorAll('.product-detail-thumb').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }
</script>