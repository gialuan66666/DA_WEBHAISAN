<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($username === 'admin' && $password === '123456') {

        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $username;

        header('Location: Lab01-bai3-Home.php');
        exit();

    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .login-box {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
        }

        .title {
            text-align: center;
            color: #d63384;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn-login {
            background: #d63384;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #b0256b;
        }
    </style>
</head>

<body>

    <div class="login-box shadow">

        <h2 class="title">
            SHOP SÁCH ONLINE
        </h2>

        <?php if($error != ""): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">
                    Username
                </label>

                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Nhập username"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Nhập password"
                       required>
            </div>

            <button type="submit"
                    class="btn btn-login text-white w-100">
                Đăng nhập
            </button>

        </form>

        <p class="text-center text-muted mt-3">

        </p>

    </div>

</body>

</html>