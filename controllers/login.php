<?php
include "data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($_SESSION['users'] as $user) {

        if ($user['email'] === $email && password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;

            
            header('Location: /');
            exit();
        }
    }

    echo "Email hoặc mật khẩu không đúng!";
}