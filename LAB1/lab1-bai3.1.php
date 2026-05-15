<?php

session_start();

if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == 'admin@gmail.com' && $password == '123456') {

        $_SESSION['is_loggin_in'] = true;
        $_SESSION['email'] = $email;

        header('Location: lab1-bai3.3.php');
        exit();

    } else {

        echo "
            <div class='alert alert-danger text-center'>
                Sai email hoặc mật khẩu
            </div>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Đăng nhập</title>

    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<form action="" method="POST" class="w-50 mx-auto mt-5 p-4 shadow rounded bg-white">

    <h2 class="text-center text-primary mb-4">
        Đăng nhập
    </h2>

    <!-- EMAIL -->
    <div class="mb-3">

        <label class="form-label">
            Email
        </label>

        <input 
            type="email"
            name="email"
            class="form-control"
            placeholder="Nhập email..."
            required
        >

    </div>

    <!-- PASSWORD -->
    <div class="mb-3">

        <label class="form-label">
            Mật khẩu
        </label>

        <input 
            type="password"
            name="password"
            class="form-control"
            placeholder="Nhập mật khẩu..."
            required
        >

    </div>

    <!-- BUTTON -->
    <button type="submit" class="btn btn-primary w-100">

        Đăng nhập

    </button>

</form>

</body>
</html>