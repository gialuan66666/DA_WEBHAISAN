<?php
$pageTitle = 'Liên hệ - SeaFresh';
require_once './view/layouts/client/header.php';
?>

<section class="page-banner"><div class="container"><h1>Liên hệ</h1><p>Gửi thông tin để SeaFresh tư vấn nhanh cho bạn.</p></div></section>

<section class="container py-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="summary-box h-100">
                <h3 class="fw-bold text-blue mb-4">Thông tin liên hệ</h3>
                <p><i class="fa-solid fa-phone text-coral"></i> 0909 888 999</p>
                <p><i class="fa-solid fa-envelope text-coral"></i> support@seafresh.vn</p>
                <p><i class="fa-solid fa-location-dot text-coral"></i> Ninh Kiều, Cần Thơ</p>
                <p><i class="fa-solid fa-clock text-coral"></i> 7:00 - 21:00 mỗi ngày</p>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="form-box">
                <h3 class="fw-bold text-blue mb-4">Gửi tin nhắn</h3>
                <form class="row g-3">
                    <div class="col-md-6"><input type="text" class="form-control" placeholder="Họ tên"></div>
                    <div class="col-md-6"><input type="text" class="form-control" placeholder="Số điện thoại"></div>
                    <div class="col-12"><input type="email" class="form-control" placeholder="Email"></div>
                    <div class="col-12"><textarea class="form-control" rows="5" placeholder="Nội dung cần tư vấn"></textarea></div>
                    <div class="col-12"><button type="button" class="btn btn-blue rounded-pill px-4">Gửi liên hệ</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once './view/layouts/client/footer.php'; ?>
