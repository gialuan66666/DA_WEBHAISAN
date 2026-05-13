<?php
include "data.php";
include "funtion/login.php";
?>

<div class="cc-auth-wrapper">
    <div class="cc-auth-box">
        <h3 class="cc-auth-title">Đăng nhập</h3>

        <form method="post">

            <div class="cc-auth-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập email">
            </div>

            <div class="cc-auth-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <button class="cc-auth-btn" name="login">Đăng nhập</button>

            <div class="cc-auth-footer">
                Chưa có tài khoản?
                <a href="/register">Đăng ký</a>
            </div>

        </form>
    </div>
</div>