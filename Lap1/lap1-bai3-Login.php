<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($username === 'admin' && $password === '123456') {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $username;

        header('Location: lap1-bai3-Home.php');
        exit;
    } else {
        echo 'Đăng nhập thất bại!';
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>