<?php
include "data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            echo "Email đã tồn tại!";
            return;
        }
    }

    $newUser = [
        "id" => count($_SESSION['users']) + 1,
        "username" => $username,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "address" => $address,
        "phone" => $phone
    ];

    $_SESSION['users'][] = $newUser;

    header("Location: /login");
    exit();
}