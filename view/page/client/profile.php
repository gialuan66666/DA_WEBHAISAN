<?php
include "data.php";

if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}

$user = $_SESSION['user'];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0" style="border-radius:20px;">

                <!-- HEADER -->
                <div class="text-center py-4"
                    style="background: linear-gradient(135deg, rgb(19,103,104), rgb(40,160,160)); border-radius:20px 20px 0 0;">

                    <i class="fa-solid fa-user-circle"
                        style="font-size:90px; color:white;"></i>

                    <h4 class="mt-3 text-white">
                        <?= $user['username'] ?>
                    </h4>

                    <p class="text-light mb-0">
                        <?= $user['email'] ?>
                    </p>
                </div>

                <!-- BODY -->
                <div class="p-4">

                    <h5 class="mb-3" style="color: rgb(19,103,104);">
                        Thông tin cá nhân
                    </h5>


                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Họ tên:</div>
                        <div class="col-7"><?= $user['username'] ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Email:</div>
                        <div class="col-7"><?= $user['email'] ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Địa chỉ:</div>
                        <div class="col-7">
                            <?= $user['address'] ?? 'Chưa cập nhật' ?>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Số điện thoại:</div>
                        <div class="col-7">
                            <?= $user['phone'] ?? 'Chưa cập nhật' ?>
                        </div>
                    </div>

                    <hr>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-between">

                        <a href="/" class="btn btn-outline-secondary">
                            ← Trang chủ
                        </a>

                        <a href="/funtion/logout.php"
                            class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc muốn đăng xuất không?')">
                            Đăng xuất
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>