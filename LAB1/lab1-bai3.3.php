<?php

session_start();

if (
    !isset($_SESSION['is_loggin_in']) ||
    $_SESSION['is_loggin_in'] !== true
) {

    header('Location: lab1-bai3.1.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Trang chủ</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow p-5 text-center">

            <h1 class="text-primary mb-4">

                Xin chào <?= $_SESSION['username'] ?> !

            </h1>

            <p class="text-muted">

                Chào mừng bạn đến với hệ thống.

            </p>

            <!-- LOGOUT -->
            <a href="lab1-bai3.2.php" class="btn btn-danger">
                Đăng xuất
            </a>

        </div>

    </div>

</body>

</html>