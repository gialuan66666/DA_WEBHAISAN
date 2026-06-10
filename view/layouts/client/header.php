<?php
$pageTitle = $pageTitle ?? 'SeaFresh - Hải sản tươi sống';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/client/css/style.css">
</head>
<body>

<header class="sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/home">
                <span class="logo-circle"><i class="fa-solid fa-fish"></i></span>
                <div>
                    <strong>SeaFresh</strong>
                    <small class="d-block text-muted">Hải sản tươi mỗi ngày</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?= $currentPage == '/home' ? 'active' : '' ?>" href="/home">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage == '/product' ? 'active' : '' ?>" href="/product">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage == '/about' ? 'active' : '' ?>" href="/about">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage == '/contact' ? 'active' : '' ?>" href="/contact">Liên hệ</a></li>
                </ul>

                <form class="d-flex me-lg-3 mb-3 mb-lg-0" action="/product" method="get">
                    <input class="form-control rounded-start-pill" type="search" name="q" placeholder="Tìm hải sản...">
                    <button class="btn btn-blue rounded-end-pill"><i class="fa-solid fa-search"></i></button>
                </form>

                <div class="d-flex align-items-center gap-2">
                    <a href="/login" class="btn btn-outline-primary rounded-pill d-none d-md-inline-flex">Đăng nhập</a>
                    <a href="/cart  " class="btn btn-orange rounded-pill position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <!-- <span class="cart-badge">3</span> -->
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
