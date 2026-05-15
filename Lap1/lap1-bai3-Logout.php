<?php
session_start();

session_destroy();

header('Location: lap1-bai3-Login.php');
exit;