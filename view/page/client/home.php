<?php
$pageTitle = 'SeaFresh - Trang chủ';
require_once './data/data.php';
require_once './view/layouts/client/header.php';
?>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="hero-badge">Tươi ngon từ biển Việt Nam</span>
                <h1>Hải Sản Tươi Sống Đánh Bắt Trong Ngày</h1>
                <p>Từ tàu đánh bắt đến bàn ăn của bạn trong thời gian ngắn nhất. Cam kết tươi, sạch, rõ nguồn gốc.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/product" class="btn btn-orange btn-lg rounded-pill px-4">Khám phá menu</a>
                    <a href="/contact" class="btn btn-light btn-lg rounded-pill px-4">Liên hệ ngay</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrap">
                    <img src="https://images.unsplash.com/photo-1615141982883-c7ad0e69fd62?auto=format&fit=crop&w=1000&q=80" class="img-fluid hero-img" alt="Hải sản">
                    <div class="floating-card"><strong>Giao nhanh 2h</strong><br><small>Nội thành TP.HCM & Cần Thơ</small></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="section-title">
        <h2>Flash Sale Hải Sản</h2>
        <p>Ưu đãi theo giờ, số lượng có hạn</p>
        <div class="countdown"><span class="hours">02</span><span class="minutes">18</span><span class="seconds">45</span></div>
    </div>
    <div class="row g-4">
        <?php foreach(array_slice($products ?? [], 0, 4) as $product): ?>
            <div class="col-sm-6 col-lg-3">
                <?php include './view/layouts/client/product-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="category-section py-5">
    <div class="container">
        <div class="section-title text-center">
            <h2>Danh Mục Sản Phẩm</h2>
            <p>Chọn nhanh loại hải sản bạn cần</p>
        </div>
        <div class="row g-4">
            <?php foreach($categories as $cat): ?>
                <div class="col-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon"><i class="fa-solid <?= $cat['icon'] ?>"></i></div>
                        <h5><?= $cat['name'] ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="section-title d-flex justify-content-between align-items-end flex-wrap gap-3">
        <div><h2>Sản phẩm bán chạy</h2><p>Hải sản được khách hàng đặt nhiều nhất</p></div>
        <a href="/product" class="btn btn-outline-primary rounded-pill">Xem tất cả</a>
    </div>
    <div class="row g-4">
        <?php foreach($products as $product): ?>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <?php include './view/layouts/client/product-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="trust-section py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4"><i class="fa-solid fa-truck-fast"></i><h4>Giao hàng nhanh 2h</h4><p>Đóng gói giữ lạnh, giao đúng giờ.</p></div>
            <div class="col-md-4"><i class="fa-solid fa-eye"></i><h4>Kiểm tra trước thanh toán</h4><p>Khách được kiểm tra hàng khi nhận.</p></div>
            <div class="col-md-4"><i class="fa-solid fa-rotate-left"></i><h4>Đổi trả trong 24h</h4><p>Cam kết chất lượng sản phẩm.</p></div>
        </div>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
