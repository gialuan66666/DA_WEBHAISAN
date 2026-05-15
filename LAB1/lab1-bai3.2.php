<?php

session_start();

$_SESSION = [];

session_destroy();

header('Location: lab1-bai3.1.php');
exit;

?>