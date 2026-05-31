<?php
require_once "Controller/HomeController.php";
require_once "Controller/AdminController.php";

$page = $_GET['page'] ?? 'home';

$home = new HomeController();
$admin = new AdminController();

switch ($page) {

    case 'admin':
        $admin->dashboard(); // admin tự load layout
        break;

    case 'home':
        require "Views/client/header.php";
        $home->renderGiaoDien();
        require "Views/client/footer.php";
        break;

    default:
        echo "404";
        break;
}