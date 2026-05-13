<?php
include "data.php";
include "funtion/register.php";
?>

<div class="cc-auth-wrapper">
    <div class="cc-auth-box">
        <h3 class="cc-auth-title">Đăng ký</h3>

        <form method="POST">

            <div class="cc-auth-group">
                <label>Họ tên</label>
                <input type="text" name="username" placeholder="Nhập họ tên">
            </div>

            <div class="cc-auth-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập email">
            </div>

            <div class="cc-auth-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <div class="cc-auth-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" placeholder="Nhập địa chỉ">
            </div>

            <div class="cc-auth-group">
                <label>SĐT</label>
                <input type="text" name="phone" placeholder="Nhập số điện thoại">
            </div>

            <button class="cc-auth-btn" name="register">Đăng ký</button>

            <div class="cc-auth-footer">
                Đã có tài khoản?
                <a href="/login">Đăng nhập</a>
            </div>

        </form>
    </div>
</div>