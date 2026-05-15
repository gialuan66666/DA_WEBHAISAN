<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: lap1-bai3-Login.php');
} else {
    echo 'Chào mừng ' . $_SESSION['username'] . ' !';
}
?>

<br><br>
<a href="lap1-bai3-Logout.php">Logout</a>