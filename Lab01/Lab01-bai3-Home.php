<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: Lab01-bai3-Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .home-box {
            width: 450px;
            margin: 120px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
        }

        .title {
            color: #d63384;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .username {
            color: #0d6efd;
            font-weight: bold;
        }

        .btn-logout {
            background: #d63384;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-logout:hover {
            background: #b0256b;
            color: white;
        }
    </style>
</head>

<body>

    <div class="home-box shadow">

        <h2 class="title">
            SHOP SÁCH ONLINE
        </h2>

        <h4>
            Chào mừng
            <span class="username">
                <?= $_SESSION['username'] ?>
            </span>
            !
        </h4>

        <p class="text-muted mt-2">
            Bạn đã đăng nhập thành công vào hệ thống.
        </p>

        <a href="Lab01-bai3-Logout.php" class="btn-logout">
            Logout
        </a>

    </div>

</body>

</html>