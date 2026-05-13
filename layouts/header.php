<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHA CHA SÌ TO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand custom-logo" href="/home">
                <img src="/assets/img/CHA.png" width="120">
            </a>

            <!-- MENU -->
            <div class="collapse navbar-collapse custom-nav-wrapper">
                <ul class="navbar-nav mx-auto custom-nav">

                    <li class="nav-item">
                        <a class="nav-link custom-link" href="/home">TRANG CHỦ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-link" href="/product">SẢN PHẨM</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-link" href="/about">GIỚI THIỆU</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-link" href="/menu">MENU</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-link" href="/contact">LIÊN HỆ</a>
                    </li>

                </ul>


            </div>
            <div class="d-flex align-items-center ms-auto gap-5">
                <!-- Giỏ hàng -->
                <a href="/cart" class="position-relative text-theme-color" style="color: rgb(19,103,104); font-size: 1.3rem;">
                    <i class="fa-solid fa-cart-shopping"></i>

                </a>

                <!-- Đăng nhập -->
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                ?>

<?php if (isset($_SESSION['user'])): ?>

    <div class="dropdown d-inline-block">

        <a href="/profile"
            style="color: rgb(19,103,104); font-size: 1.3rem; text-decoration: none;">

            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['user']['username'] ?>
        </a>
    </div>

<?php else: ?>

    <a href="/login"
        style="color: rgb(19,103,104); font-size: 1.3rem;">
        <i class="fa-solid fa-user"></i>
    </a>

<?php endif; ?>
            </div>
        </div>
    </nav>