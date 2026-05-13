<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// chỉ tạo 1 lần
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        [
            "id" => 1,
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => password_hash("123456", PASSWORD_DEFAULT)
        ]
    ];
}